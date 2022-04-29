<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }  
    
    public function seller() {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function orders() {
        return $this->hasMany('App\Models\OrderProducts', 'order_id');
    }

    // public function payments() {
    //     return $this->belongsTo('App\Models\Payment', 'order_id');
    // }

    // public static function paymentDetails($order_id) {
    //     $paymentDetails = Order::where('id', $order_id)->first();
    //     return $paymentDetails;
    // }

    public static function getOrderDetails($order_id) {
       $orderDetails = Order::where('id', $order_id)->first();
       return $orderDetails;
    }    
}
