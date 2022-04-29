<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\OrderProducts;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Cart;
use Session;

class CheckOutController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function checkout(Request $request): JsonResponse
    {
        // $session_id = Auth::user()->session_id();
        if (Auth::check()) {
            $id = Auth::user()->id;
            $user = User::findOrFail($id);
            $email = Auth::user()->email;
            // $shippingDetails = array();
            $shippingCount = Shipping::where('user_id', $id)->count();
            if($shippingCount > 0) {
                $shippingDetails = Shipping::where('user_id', $id)->first();
            }

            //Update cart table with user email
            $session_id = Session::get('session_id');
            DB::table('carts')->where(['session_id' => $session_id])->update(['user_id' => $id, 'user_email' => $email]);
        }

        if($request->isMethod('post')) {

           $this->validateField();
         //    return $request->all();

           //Update User details
           User::where('id', $id)->update([
                'name' => $request->name,
                'address' => $request->address,
                'city_id' => $request->city_id,
                'state_id' => $request->state_id,
                'country_id' => $request->country_id,
                'pincode' => $request->pincode,
                'phone' => $request->phone,
           ]);

           if($shippingCount > 0) {
               //update shipping details
                // shipping country, state, and city name
                // $country = Country::where('id', $request->country_id)->first();
                // $state = State::where('id', $request->state_id)->first();
                // $city = City::where('id', $request->city_id)->first();
               if ($request->ship_to_bill == 1) {
                    /**
                     * This part executeadd when billing and shipping details are same
                     */
                    // shipping country, state, and city name
                    $country = Country::where('id', $request->country_id)->first();
                    $state = State::where('id', $request->state_id)->first();
                    $city = City::where('id', $request->city_id)->first();
                   Shipping::where('user_id', $id)->update([
                        'shipping_email' => $user->email,
                        'shipping_name' => $request->name,
                        'shipping_address' => $request->address,
                        'shipping_city' => $city->name,
                        'shipping_state' => $state->name,
                        'shipping_country' => $country->name,
                        'shipping_pincode' => $request->pincode,
                        'shipping_phone' => $request->phone,
                   ]);
                } else {
                    /**
                     * This part executeadd when billing and shipping details are not same
                     */
                   $this->validateShipping();
                    // shipping country, state, and city name
                    $country = Country::where('id', $request->shipping_country_id)->first();
                    $state = State::where('id', $request->shipping_state_id)->first();
                    $city = City::where('id', $request->shipping_city_id)->first();
                   Shipping::where('user_id', $id)->update([
                        'shipping_email'           => $user->email,
                        'shipping_name'       => $request->shipping_name,
                        'shipping_address'    => $request->shipping_address,
                        'shipping_city'    => $city->name,
                        'shipping_state'   => $state->name,
                        'shipping_country' => $country->name,
                        'shipping_pincode'    => $request->shipping_pincode,
                        'shipping_phone'      => $request->shipping_phone,
                   ]);
               }
           } else {
                //This part executeadd when shipping details not available

                if ($request->ship_to_bill == 1) {
                    /**
                     * This part executeadd when billing and shipping details are same
                     */
                    // shipping country, state, and city name
                    $ship_country = Country::where('id', $request->country_id)->first();
                    $ship_state = State::where('id', $request->state_id)->first();
                    $ship_city = City::where('id', $request->city_id)->first();
                    $shipping = new Shipping;
                    $shipping->user_id             = $id;
                    $shipping->shipping_email          = $user->email;
                    $shipping->shipping_name       = $request->name;
                    $shipping->shipping_address    = $request->address;
                    $shipping->shipping_city    = $ship_city->name;
                    $shipping->shipping_state   = $ship_state->name;
                    $shipping->shipping_country = $ship_country->name;
                    $shipping->shipping_pincode    = $request->pincode;
                    $shipping->shipping_phone      = $request->phone;
                    // Session::put('shipping', $shipping);
                    $shipping->save();
                    //   $orderId = DB::table('orders')->insertGetId($order);   //OR
                    $shipping_id = DB::getPdo()->lastInsertId();
                    // Session::put('shipping', $shipping);
                } else {
                    /**
                     * This part executeadd when billing and shipping details are not same
                     */
                    $this->validateShipping();
                    // shipping country, state, and city name
                    $shipping_country = Country::where('id', $request->shipping_country_id)->first();
                    $shipping_state = State::where('id', $request->shipping_state_id)->first();
                    $shipping_city = City::where('id', $request->shipping_city_id)->first();
                    $shipping = new Shipping;
                    $shipping->user_id             = $id;
                    $shipping->shipping_email          = $user->email;
                    $shipping->shipping_name       = $request->shipping_name;
                    $shipping->shipping_address    = $request->shipping_address;
                    $shipping->shipping_city    = $shipping_city->name;
                    $shipping->shipping_state   = $shipping_state->name;
                    $shipping->shipping_country = $shipping_country->name;
                    $shipping->shipping_pincode    = $request->shipping_pincode;
                    $shipping->shipping_phone     = $request->shipping_phone;
                    $shipping->save();
                    //   $orderId = DB::table('orders')->insertGetId($order);   //OR
                    $shipping_id = DB::getPdo()->lastInsertId();
                    Session::put('shipping_id', $shipping_id);
                }
           }

        }

        # code...
        return response()->json([
            'userDetails' => $user,
            // 'shipping' => $shippingDetails
            // 'session' => $session_id,
        ],200);
    }

    public function orderReview(Request $request): JsonResponse
    {
        $sum = 0;
        $vat = 0;
        $Total = 0;
        $subTotal = 0;
        $tax = 0;
        $discount = 0;
        $GrandTotal = "";
        //check if user authenticated
        if (Auth::check()) {

            $user = User::where('id', Auth::user()->id)->first();
            // $shippingDetails = array();
            $shippingDetails = Shipping::where('user_id', Auth::user()->id)->first();
        }
        // billng country, state, and city name
        $bcountry = Country::where('id', Auth::user()->country_id)->first();
        $bstate = State::where('id', Auth::user()->state_id)->first();
        $bcity = City::where('id', Auth::user()->city_id)->first();

        //shipping country, state, and city name
        // $shipcountry = Country::where('id', $shippingDetails->country)->first();
        // $shipstate = State::where('id', $shippingDetails->state)->first();
        // $shipcity = City::where('id', $shippingDetails->city)->first();

         $userCart = DB::table('carts')->where(['user_id' => Auth::user()->id, 'user_email' => Auth::user()->email])->get();
         foreach($userCart as $key => $product) {
             $allProducts = Product::where('id', $product->product_id)->first();
             $userCart[$key]->image = $allProducts->product_image;
             //  echo "<pre>"; print_r($userCart);

             // return $userCart->quantity;
             $sum = $sum + ($product->price * $product->quantity);
             $discount =  $product->discount_amount;
            //  $totalAfterDiscount = $sum - $discount;
             $vat       =  ($sum * 18 / 100);
             $subTotal   = sprintf('%0.2f', $sum);
             $tax        = sprintf('%0.2f', $vat);
             $Total     = ($subTotal + $tax) - $discount;
             $GrandTotal = sprintf('%0.2f', $Total);

             Session::put('Subtotal', $subTotal);
             Session::put('Tax', $tax);
             Session::put('cartTotal', $GrandTotal);
         }



         //  return $userCart;
        return response()->json([
          'reviewCart' => $userCart,
          'billing' => $user,
          'billcountry' => $bcountry->name,
          'billstate' => $bstate->name,
          'billcity' => $bcity->name,
          'shipping' => $shippingDetails,
          'shipcountry' => $shippingDetails->shipping_country,
          'shipstate' => $shippingDetails->shipping_state,
          'shipcity' => $shippingDetails->shipping_city,
          'gst'           => $tax,
          'cartSubTotal'  => $subTotal,
          'discount'      => sprintf('%0.2f', $discount),
          'cartTotal'     => $GrandTotal,
        ], 200);
    }

    /**
     * @param Request $request
     */
    public function placeOrder(Request $request) {
        $Total = 0;
        $shippingCharge = 0;
        if($request->isMethod('post')) {
            // return $request->all();
          if (Auth::check()) {
             $id = Auth::user()->id;
             $email = Auth::user()->email;

             //Get Shipping Address of user
             $shipping = Shipping::where(['user_id' => $id, 'shipping_email' => $email])->first();
          }

           //   Session::put('cartTotal', $request->GrandTotal);
           //shipping country, state, and city name
            //   $shipcountry = Country::where('id', $shippingDetails->shipping_country_id)->first();
            //   $shipstate = State::where('id', $shippingDetails->shipping_state_id)->first();
            //   $shipcity = City::where('id', $shippingDetails->shipping_city_id)->first();

          if(empty(Session::get('coupon_code'))) {
              $coupon_code = '';
          } else {
              $coupon_code = Session::get('coupon_code');
          }

          if(empty($request->Discount)) {
              $request->Discount = '';
          }

          $userCart = DB::table('carts')->where(['user_id' => $id, 'user_email' => $email])->get();
          foreach($userCart as $key => $product) {
              $product = Product::where('id', $product->product_id)->first();
          }

          $Total = $request->SubTotal + $request->Tax + $shippingCharge;
          $order = new Order;
          $order->user_id = $id;
          $order->product_id = $product->id;
          $order->shipping_id = $shipping->id;
          $order->session_id = Session::get('session_id');
          $order->status = "New";
         //    $order->payment_mode = $request->payment_mode;
          $order->subTotal = $request->SubTotal;
          $order->tax = $request->Tax;
          $order->shipping_charge = 0;
          // Total = sum + shipping charge + Tax;
         //   $order->total = $Total;
          $order->coupon = $coupon_code;
          $order->discount = $request->Discount;
          $order->grandTotal = $request->GrandTotal;

          Session::put('my_order', $order);
          $order->save();
         //   $orderId = DB::table('orders')->insertGetId($order);   //OR
          $order_id = DB::getPdo()->lastInsertId();
          Session::put('order_id', $order_id);

          $cartItems = DB::table('carts')->where(['user_id' => $id, 'user_email' => $email])->get();

            foreach($cartItems as $item) {
                $orderitems = new OrderProducts;
                $orderitems->order_id = $order_id;
                // $orderitems->user_id = $id;
                // $orderitems->product_id = $item->product_id;
                $orderitems->product_name	= $item->product_name;
                // $orderitems->product_code	= $item->product_code;
                $orderitems->product_size = $item->size;
                // $orderitems->product_color = $item->product_color;
                $orderitems->product_price = $item->price;
                // $orderitems->discount = $item->discount_amount;
                $orderitems->quantity = $item->quantity;
                Session::put('order_items', $orderitems);
                $orderitems->save();
            }

           $payment = new Payment;
           $payment->user_id = $id;
           $payment->order_id = $order_id;
           $payment->payment_mode = $request->payment_mode;
           $payment->save();
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function thanks(Request $request) {
        if($request->isMethod('post')) {
                $id = Auth::user()->id;
                $email = Auth::user()->email;

                DB::table('carts')->where(['user_id' => $id, 'user_email' => $email])->delete();

                Session::forget('coupon_code');
                Session::forget('my_order');
                Session::forget('order_items');
         }

         if(Auth::check()) {
            $orderId = Session::get('order_id');
            $cartTotal = Session::get('cartTotal');
            Session::forget('order_id');
            Session::forget('cartTotal');
            return response()->json([
               'order_id' => $orderId,
               'cartTotal' => $cartTotal 
            ], 200);
        }
    }

    /**
     *
     */
    public function myOrders(): JsonResponse
    {
    //    $id = Auth::user()->id;
    //    $email = Auth::user()->email;

       $orderCount = Order::with('orders')->where(['user_id' => Auth::user()->id])->count();

       $orders = Order::where(['user_id' => Auth::user()->id])->orderBy('id', 'DESC')->get();

    //    $paymode = Payment::where(['user_id' => Auth::user()->id, 'order_id' => $orders->id])->get();
       
    //        foreach($paymode as $key => $item)
    //        {
    //            $payment = Payment::where('order_id', $item->order_id)->first();
    //            $item[$key]->payment_mode = $payment->payment_mode;
    //        }

     return response()->json([
           'orderCount' => $orderCount,
           'order' => $orders,
        //    'payment' => $paymode
       ], 200);
    }

    /**
     * @param null $order_id
     * @return JsonResponse
     */
    public function usersOrderDetail($orderId): JsonResponse
    {
        $id = Auth::user()->id;

        // $orderDetails = array();
        $orderDetails = Order::with('orders')->where(['id' => $orderId, 'user_id' => $id])->get();

        foreach ($orderDetails as $key => $item) {
          foreach ($item->orders as $key => $product) {
              # code...
              $allProducts = Product::where('id', $product->id)->first();
              $productAttribute = ProductAttribute::where('id', $product->id)->first();
              $item->orders[$key]->image = $allProducts->product_image;
              $item->orders[$key]->color = $allProducts->product_color;
              $item->orders[$key]->product_code = $productAttribute->sku;
              $item->orders[$key]->discount = $item->discount;
              //  echo "<pre>"; print_r($userCart);
          }
        }
        return response()->json([
           'order' => $orderDetails
        ], 200);
    }

    protected function validateField(): array
    {
        return request()->validate([
             'name'       => 'required',
             'address'    => 'required',
             'pincode'    => 'required',
             'country_id' => 'required',
             'state_id'   => 'required',
             'city_id'    => 'required',
             'phone'      => 'required',
        ]);
     }

    protected function validateShipping(): array
    {
        return request()->validate([
            'shipping_name'       => 'required',
            'shipping_address'    => 'required',
            'shipping_city_id'    => 'required',
            'shipping_pincode'    => 'required',
            'shipping_state_id'   => 'required',
            'shipping_country_id' => 'required',
            'shipping_phone'      => 'required',
        ]);
    }

}
