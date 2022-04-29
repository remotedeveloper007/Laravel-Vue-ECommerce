<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Payment;
use App\Models\ProductAttribute;
use App\Models\OrderProducts;
use Illuminate\Http\Request;
use App\Models\Shipping;
use Illuminate\Http\JsonResponse;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Fetch All Customers Order details from Order Table
    */
    public function getOrder(): JsonResponse
    {
        $order = Order::get();

        // foreach($order as $item) {
        //     $user = User::where('id', $item->user_id)->first();
        //     // foreach($user as $value) {
        //         $payment = Payment::where(['user_id' => $user->id, 'order_id' => $item->id])->first();
        //     // }
        // } 
        $orderCount = Order::count();
        return \response()->json([
            'order' => $order,
            // 'user'  => $user,
            // 'payment' => $payment
            'totalOrder' => $orderCount
        ]);
    }

    /**
     * Get Order Details by Order Id
     * @param $id
    */
    public function getOrderDetails($order_id): JsonResponse
    {
        $orderDetails = Order::with('orders')->where('id', $order_id)->get();
                // echo "<pre>"; print_r($orderDetails);
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
            'order' => $orderDetails,
        ], 200);
    }

    public function otherDetailsByorderId($orderId){
        $order = Order::where('id', $orderId)->first();
        $user_id = $order->user_id;
        $user = User::where('id', $user_id)->first();
        $shipping_id = $order->shipping_id;
        $shipping = Shipping::where('id', $shipping_id)->first();
        $order_number =  $order->order_number;
        $payment = Payment::where('order_number', $order_number)->first();
        // echo "<pre>"; print_r($paymentDetails);exit();

        return \response()->json([
            'order' => $order_number,
            'user' => $user,
            'payment' => $payment,
            'shipping' => $shipping
        ], 200);
    }

    public function updateOrderStatus(Request $request, $id) {
       if($request->isMethod('post')){
         $order = $request->all(); 
         Order::where('id', $id)->update(['status' => $order['status']]);          
       }
    }

}
