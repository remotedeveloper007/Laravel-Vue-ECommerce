<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    // public $fillable = ['item_number','transaction_id','currency_code','payment_status'];

    // public function create(\PayPal\Rest\ApiContext $apiContext)
    // {
    // }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public static function paymentDetails($order_id) {
        $paymentDetails = Payment::where('order_id', $order_id)->first();
        return $paymentDetails;
    }
}
