<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function payment(Request $request) {
        $product=Product::find($request->id);    
        return view('payment',compact('product'));
    }  
    
    public function paymentInfo(Request $request){        
        if($request->tx){
            if($payment=Payment::where('transaction_id',$request->tx)->first()){
                $payment_id=$payment->id;
            } else {
                $payment=new Payment;
                $payment->item_number=$request->item_number;
                $payment->transaction_id=$request->tx;
                $payment->currency_code=$request->cc;
                $payment->payment_status=$request->st;
                $payment->save();
                $payment_id=$payment->id;
            }
        return 'Pyament has been done and your payment id is : '.$payment_id;
        
        }else{
            return 'Payment has failed';
        }
    } 
}
