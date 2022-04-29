<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\Cart;
use App\Models\User;
use App\Models\City;
// use App\Models\State;
use App\Models\Order;
use App\Models\Coupon;
// use App\Models\Country;
use App\Models\Product;
// use App\Models\Shipping;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use App\Models\OrderProducts;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //  $cart = $request->all();
        //  return $data;
        $this->validate( $request, [
            'size' => 'required',
            'quantity' => 'required'
         ]);

        $product = Product::findOrFail($id);
        //
        $product = Product::where('id', $id)->first();

        if(Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = 0;
        } 

        if(Auth::check()){
            $user_email = Auth::user()->email;
        } else {
            $user_email = '';
        }
        // if(empty($request->user_url)){
        //     $user_url = '';
        // } else {
        //     $user_url = $request->ip();
        // }
        
        $session_id = Session::get('session_id');
        if(empty($session_id)) {
            $session_id = session_create_id(Str::random(256));
            // $session_id = Str::random(256);
            session()->put('session_id', $session_id);
        }

        
        // $proSize = explode('/', $request->size);
        // echo "<pre>";print_r($proSize);exit();

        if(Auth::check()) {
            // $countProducts = DB::table('cart')->where([
            $countProducts = Cart::where([    
                'user_id'       => $user_id,
                'product_id'    => $id,
                'product_color' => $product->product_color,
                'size'          => $request->size,
                'user_email'    => $user_email
             ])->count();
        } else {
            $countProducts = DB::table('carts')->where([
                'product_id'    => $id,
                'product_color' => $product->product_color,
                'size'          => $request->size,
                'session_id'    => $session_id
             ])->count();
        }

        if($countProducts > 0) {
            return response()->json([
                'cartItems' => $countProducts
            ]);     
        } else {
            $getSKU = ProductAttribute::select('sku')->where(['product_id' => $id,'size' => $request->size])->first();
                DB::table('carts')->insert([
                    'product_id'    => $id,
                    'user_id'       => $user_id,
                    'product_name'  => $product->product_name,
                    'product_code'  => $getSKU->sku,
                    'product_color' => $product->product_color,
                    // 'size'          => $proSize[1],
                    'size'          => $request->size,
                    'price'         => $request->price,
                    'quantity'      => $request->quantity,
                    'user_email'    => $user_email,
                    'ip_address'    => $request->ip(),
                    'session_id'    => $session_id
                ]);
            ProductAttribute::where('sku', $getSKU->sku)->decrement('stock', $request->quantity);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        // $session_id = $request->session()->get('session_id');
        // $userCart = Cart::where(['session_id' => $session_id])->get();
        // return $userCart;          
        //
         if(Auth::check()) {
            $id = Auth::user()->id;
            $email = Auth::user()->email;
             $userCart = Cart::where(['user_id' => $id, 'user_email' => $email])->get();
   

             foreach($userCart as $key => $product) {
                $allProducts = Product::where('id', $product->product_id)->first();
                $userCart[$key]->image = $allProducts->product_image;
                // echo "<pre>"; print_r($userCart);
            } 
            return response()->json([
                'cart' => $userCart,          
            ], 200);            
         } else {
            $session_id = $request->session()->get('session_id');
            // return $session_id;
            $userCart = Cart::where(['session_id' => $session_id])->get();

            foreach($userCart as $key => $product) {
                $allProducts = Product::where('id', $product->product_id)->first();
                $userCart[$key]->image = $allProducts->product_image;
                // echo "<pre>"; print_r($userCart);
            }
            return response()->json([
                'cart' => $userCart,           
            ], 200);            
        }                           

    }

    public function cartAmount() {
        $sum = 0;
        $vat = 0;
        $Total = 0;
        $subTotal = 0;
        $tax = 0;
        $GrandTotal = 0; 

        $session_id = $request->session()->get('session_id');
        $userCart = Cart::where(['session_id' => $session_id])->get();        
        //  return $userCart;
        $countProducts = DB::table('carts')->where([
            // 'product_id'    => $id,
            // 'product_color' => $product->product_color,
            // 'size'          => $request->size,
            'session_id'    => $session_id
         ])->count();

        foreach($userCart as  $product) {
            // return $userCart->quantity;
            $sum += $product->price * $product->quantity; 
            $vat       =  ($sum * 18) / 100;
            $subTotal   = sprintf('%0.2f', $sum); 
            $tax        = sprintf('%0.2f', $vat);
            $Total     = $subTotal + $tax;
            $GrandTotal = sprintf('%0.2f', $Total);         
            
        }
        return response()->json([
            'gst'           => $tax,
            'cartSubTotal'  => $subTotal,
            'cartTotal'     => $GrandTotal,
            'cartItems' => $countProducts
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function quantityUp($id = null)
    {
        $cartDetails = DB::table('carts')->where('id', $id)->first();
        $attributeStock = ProductAttribute::where('sku', $cartDetails->product_code)->first();
        //

        if($attributeStock->stock > 0) {
            DB::table('carts')->where('id', $id)->increment('quantity', 1);
            ProductAttribute::where('sku', $cartDetails->product_code)->decrement('stock', 1);            
        } else {
            $cartDetails = DB::table('carts')->where('id', $id)->first();
            $attributeStock = ProductAttribute::where('sku', $cartDetails->product_code)->first(); 
            $stock = $attributeStock->stock;          
            return response()->json([
                'availableStocks' => $stock,
            ]);            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function quantityDown($id = null)
    {
        $cartDetails = DB::table('carts')->where('id', $id)->first();
        $attributeStocks = ProductAttribute::where('sku', $cartDetails->product_code)->first();        
        //
        DB::table('carts')->where('id', $id)->decrement('quantity', 1);
        ProductAttribute::where('sku', $cartDetails->product_code)->increment('stock', 1);
    }

    /**
     * Apply Coupon Discount on Cart Tatal
     */
    public function getCartAmount(Request $request) {

        if($request->isMethod('post')) {
            // $data = $request->all();
            $couponCount = Coupon::where('coupon_code', $request->coupon_code)->count();
            
            // To check Coupon is exist or not 
            if($couponCount == 0) {
                // echo "This Coupon doesn't exist";
                return response()->json([ 
                    'couponCount' => $couponCount 
                ]);
            } else {
                $total_amount = 0;
                $totalAfterDiscount = 0;
                $vat = 0;
                $Total = 0;
                $subTotal = 0;
                $tax = 0;
                $discount = 0;
                $GrandTotal = 0;             

                $session_id = Session::get('session_id');
                // $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
                if(Auth::check()) {
                    $id = Auth::user()->id;
                    $email = Auth::user()->email;
                     $userCart = DB::table('carts')->where(['user_id' => $id, 'user_email' => $email])->get();
                 } else {
                    // $session_id = Session::get('session_id');
                    // return $session_id;
                    $userCart = DB::table('carts')->where(['session_id' => $session_id])->get();
                 }                
                Session::put('coupon_code', $request->coupon_code);
                $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();
                
                //get current date
                $currentDate = date('Y-m-d');
                // To check Coupon is Active or Not
                if($coupon->status == 0) {
                    // echo "This Coupon is not Active";
                    return response()->json([ 
                        'status' => $coupon->status 
                    ]);
                } elseif($coupon->expiry_date < $currentDate) {

                    // echo "This Coupon is Expired";
                    return response()->json([ 
                        'error' => "Coupon is expired" 
                    ]);
                } elseif($coupon->amount_type == "Fixed") {
                    // To check Coupon discount amount_type is fixed and calculate discount for each item
                    foreach($userCart as $key => $product) {
                        // return $userCart->quantity;
                        $total_amount += $product->price * $product->quantity;
                                                 
                        if(Auth::check()) {
                            $id = Auth::user()->id;
                            $email = Auth::user()->email;
                            $cartItems = DB::table('carts')->where(['user_id' => $id, 'user_email' => $email])->get();
                            foreach ($cartItems as $price) {
                                # code...
                                DB::table('carts')->where(['user_id' => $id, 'user_email' => $email])->update(['discount_amount' => $coupon->amount]);
                            }                            
                        } else {
                            foreach ($cartItems as $price) {
                                # code...
                                DB::table('carts')->where(['session_id' => $session_id])->update(['discount_amount' => $coupon->amount]);
                            }                     
                        }                        
                    }                    
                    $totalAfterDiscount = ($product->price * $product->quantity) - $coupon->amount;                    
                    $vat        = ($totalAfterDiscount * 18) / 100;
                    $subTotal   = sprintf('%0.2f', $total_amount); 
                    $tax        = sprintf('%0.2f', $vat);
                    $Total      = round($totalAfterDiscount + $tax);
                    $GrandTotal = sprintf('%0.2f', $Total); 

                    // Session::put('coupon_code', $request->coupon_code);
                   
                    return response()->json([
                        'gst'           => $tax,
                        'cartSubTotal'  => $subTotal,
                        'discount'      => $coupon->amount, 
                        'cartTotal'     => $GrandTotal
                    ], 200);                
                } else {
                    // To check Coupon discount amount_type is Percentage and calculate discount for each item
                    foreach($userCart as $key => $product) {
                        // return $userCart->quantity;
                        $total_amount += $product->price * $product->quantity;
                        if (Auth::check()) {
                            $id = Auth::user()->id;
                            $email = Auth::user()->email;
                            foreach ($userCart as $key => $pro) {
                                $couponAmount = $pro->price * ($coupon->percent_off / 100); 
                                # code...
                                DB::table('carts')->where(['user_id' => $id, 'user_email' => $email])->update(['discount_amount' => $couponAmount]);
                            }                                                    
                        } else {
                            foreach ($userCart as $key => $pro) {
                                $couponAmount = $pro->price * ($coupon->percent_off / 100); 
                                # code...
                                DB::table('carts')->where(['session_id' => $session_id])->update(['discount_amount' => $couponAmount]); 
                            }                        
                        }                                            
                    }                     
                    
                    $totalAfterDiscount = $total_amount - $couponAmount;
                    $vat        = ($totalAfterDiscount * 18) / 100;
                    $subTotal   = sprintf('%0.2f', $total_amount); 
                    $tax        = sprintf('%0.2f', $vat);
                    $Total      = round($totalAfterDiscount + $tax);
                    $GrandTotal = sprintf('%0.2f', $Total);

                    
              
                    return response()->json([
                        'gst'           => $tax,
                        'cartSubTotal'  => $subTotal,
                        'discount'      => $couponAmount,
                        'cartTotal'     => $GrandTotal
                    ], 200);
                }
                
            }
        }

        $sum = 0;
        $vat = 0;
        $Total = 0;
        $subTotal = 0;
        $tax = 0;
        $discount = 0;
        $GrandTotal = 0; 

        // $session_id = Session::get('session_id');
        // $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
        if(Auth::check()) {
            $id = Auth::user()->id;
            $email = Auth::user()->email;
             $userCart = DB::table('carts')->where(['user_id' => $id, 'user_email' => $email])->get();
         } else {
            $session_id = Session::get('session_id');
            // return $session_id;
            $userCart = DB::table('carts')->where(['session_id' => $session_id])->get();
         }                
        //  return $userCart;

        foreach($userCart as  $product) {
            // return $userCart->quantity;
            $sum += $product->price * $product->quantity; 
            $discount  = $product->discount_amount;
            $totalAfterDiscount = $sum - $discount;
            $vat        =  ($totalAfterDiscount * 18) / 100;
            $subTotal   = sprintf('%0.2f', $sum); 
            $tax        = sprintf('%0.2f', $vat);
            $Total      = $totalAfterDiscount + $tax;
            $GrandTotal = sprintf('%0.2f', $Total);                     
        }
        
        return response()->json([
            'gst'           => $tax,
            'cartSubTotal'  => $subTotal,
            'discount'      => $discount,
            'cartTotal'     => $GrandTotal,
            // 'session'        => $session_id
        ], 200);
    }


    /**
     * Remove the specified resource from cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeProduct($id = null, $quantity = null)
    {  
        // return  $quantity;
        $cartDetails = DB::table('carts')->where('id', $id)->first();
        $attributeStocks = ProductAttribute::where('sku', $cartDetails->product_code)->first();
        //
        DB::table('carts')->where('id', $id)->delete();
        ProductAttribute::where('sku', $cartDetails->product_code)->increment('stock', $quantity);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }

    protected function validateField() {
       return request()->validate([
            'name'       => 'required',
            'address'    => 'required',
            'pincode'    => 'required',
            'country_id' => 'required',
            'state_id'   => 'required',
            'city_id'    => 'required',
            'phone'      => 'required'           
       ]);
    }

	
}
