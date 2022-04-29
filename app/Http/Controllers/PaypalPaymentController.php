<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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
use DB;
use Session;
use Cart;


class PaypalPaymentController extends Controller
{
    /**
     * @param Request $request
     */
    public function paypalOrder(Request $request)
    {
        if($request->isMethod('post')) {
           $Total = 0;
           $shippingCharge = 0;
           if (Auth::check()) {
              $id = Auth::user()->id;
              $email = Auth::user()->email;

              //Get Shipping Address of user
              $shipping = Shipping::where(['user_id' => $id, 'shipping_email' => $email])->first();
           }
           if(empty(Session::get('coupon_code'))) {
              $coupon_code = '';
           } else {
              $coupon_code = Session::get('coupon_code');
           }

           /** */
           $data = $request->all();

        //    $paymentId = $request->payment_id;
           $order_number = $request->orderID;
           Session::put('order_no', $order_number);

           $payerId = $data['payer_id'];
        //    echo "<pre>"; print_r($data);exit();


           /** */
           $Tax = Session::get('Tax');
        //    $SubTotal = Session::get('Subtotal');
           $GrandTotal = Session::get('cartTotal');

           $userCart = DB::table('carts')->where(['user_id' => $id, 'user_email' => $email])->get();
           foreach($userCart as $key => $product) {
                 $product = Product::where('id', $product->product_id)->first();
           }

           if(empty($userCart->discount_amount)) {
              $discount = '';
           } else {
              $discount = $userCart['discount_amount'];
           }

           $payment = new Payment;
           $payment->id = $request->payment_id;
           $payment->user_id  = $id;
         //   $payment->order_id = $orderId;
           $payment->order_number = $order_number;
           $payment->payer_id = $payerId;
        //    $payment->transaction_id= $txn_id;   //$this is invoice_number
           $payment->payment_mode = 'Paypal';
        //    $payment->currency_code= $currency_code;
        //    $payment->payment_status= $payment_status;
           $payment->save();

           $paymentId = DB::getPdo()->lastInsertId();

           $order = new Order;           
           $order->user_id = $id;
           $order->product_id = $product->id;
           $order->shipping_id = $shipping->id;
           $order->order_number = $order_number;
           $order->payer_id = $payerId;
         //   $payment->invoice_id  = Session::get('invoice_id');    //$this is invoice_number
           $order->session_id = Session::get('session_id');
           $order->status = "New";
           $order->subTotal = Session::get('Subtotal');
           $order->tax = $Tax;
           $order->shipping_charge = 0;
           $order->coupon = $coupon_code;
        //    $order->discount = $discount;
           $order->grandTotal = $GrandTotal;

            $order->save();

            $orderId = DB::getPdo()->lastInsertId();
            Session::put('order_id', $orderId);           

           //
           DB::table('payments')->where(['order_number' => $order_number, 'payer_id' => $payerId])->update(['order_id' => $orderId]);            

           /** */
           $cartItems = DB::table('carts')->where(['user_id' => $id, 'user_email' => $email])->get();
           foreach($cartItems as $item) {
              $orderitems = new OrderProducts;
              $orderitems->order_id = $orderId;
              $orderitems->order_number = $order_number;
              $orderitems->product_name	= $item->product_name;
              // $orderitems->product_code	= $item->product_code;
              $orderitems->product_size = $item->size;
              // $orderitems->product_color = $item->product_color;
              $orderitems->product_price = $item->price;
              $orderitems->quantity = $item->quantity;
              $orderitems->save();
           }

        
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function paypalPaymentStatus(Request $request): JsonResponse
    {
        if($request->isMethod('post')) {

            DB::table('carts')->where(['user_id' => Auth::user()->id, 'user_email' => Auth::user()->email])->delete();

            Session::forget('Tax');
            Session::forget('Subtotal');
            Session::forget('coupon_code');
            Session::forget('my_order');
            Session::forget('order_items');
            Session::forget('invoice_id');
        }


         if(Auth::check()) {          
            // $orderId   = Session::get('order_no');
            // $cartTotal = Session::get('cartTotal');
            // Session::forget('order_id');
            // Session::forget('cartTotal');
            return response()->json([
                'orderNo' => Session::get('order_no'),
                'cartTotal' => Session::get('cartTotal'),

            ], 200);
         }

            Session::forget('order_no');
            Session::forget('cartTotal');
    }


}
