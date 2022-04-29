<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

   /** Paypal Details classes **/
   use PayPal\Rest\ApiContext;
   use PayPal\Auth\OAuthTokenCredential;
   use PayPal\Api\Amount;
   use PayPal\Api\Details;
   use PayPal\Api\Item;
   use PayPal\Api\ItemList;
   use PayPal\Api\Payer;
   use PayPal\Api\Payment;
   use PayPal\Api\RedirectUrls;
   use PayPal\Api\PaymentExecution;
   use PayPal\Api\Transaction;
   use PayPal\Api\InputFields;

   use PayPal\Exception\PayPalConnectionException;
   use Exception;
   use App\Paypal\CreatePayment;
   use App\Paypal\ExecutePayment;

   use Session;

class PaypalController extends Controller
{
    //
    protected $apiContext;

    public function __construct()
     {
        #Main Configuration in Construct
        /** setup PayPal api context **/
        $this->apiContext = new \PayPal\Rest\ApiContext(
         new \PayPal\Auth\OAuthTokenCredential(
            //  config('services.paypal.id'),     // ClientID
            //  config('services.paypal.secret'),  // ClientSecret
            'Aa7x95osIZr7uY7raa-nhjxIlF8lXyFF3etHd4R_PeaCT89mqUkuBNOOHWOU0xLYZseBYUTGuI-ZzA12',     // ClientID
            'EKvjGF5PQMaM78xAsTM4J5AsvGPBi7aUvWVVQ2yt0qUluY9bK1JXjGgzdnNxsb4e8qVIPc1XRl6JYWYN',  // ClientSecret

         ));
     }

    /** This method sets up the paypal payment.
     **/
    public function paypalCreate(): Payment
    {
       #code..
       $payment = new CreatePayment();
       return $payment->create();
    }

    /**
     * This method confirms if payment with paypal was
     *  processed successful and then execute the payment,
     * we have 'paymentId, PayerID and token' in query  string.
     * @param Request $request
     * @return array|Payment
     */

    public  function paypalExecute(Request $request)
    {
       #code..
//          $payment = new ExecutePayment();
//          return $payment->execute();


       $paymentId = Session::get('paymentId');
       $payment = Payment::get($paymentId, $this->apiContext);

      //
      $execution = new PaymentExecution();
    //   $execution->setPayerId($request->input('PayerID'));
      $execution->setPayerId(request('PayerID'));

      //
      $subTotal = Session::get('Subtotal');
      $tax = Session::get('Tax');
      $details = new Details();
      $details->setShipping(0.0)
              ->setTax($tax)
              ->setSubtotal($subTotal);
       //   echo "<pre>"; print_r($subTotal); exit();

      //
      $GrandTotal = Session::get('cartTotal');
      $amount = new Amount();
      $amount->setCurrency('USD');
      $amount->setTotal($GrandTotal);
      $amount->setDetails($details);

      //
      $transaction = new Transaction();
      $transaction->setAmount($amount);

      $execution->addTransaction($transaction);

      //
    try {

            $result = $payment->execute($execution,  $this->apiContext);

             // echo "<pre>"; print_r($result);
             if ($result->getState() == 'approved') {
                $invoiceId = $result->transactions[0]->InvoiceId();
                Session::put('invoice_id', $invoiceId);

                // echo "<pre>"; print_r($invoiceId);
                Session::put('payments', $result);
            }
      } catch (Exception $ex) {

            exit(1);
      }

      return $result;

    }

}
