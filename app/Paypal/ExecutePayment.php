<?php


namespace App\Paypal;


use Illuminate\Http\Request;
use Session;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\Capture;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;



class ExecutePayment extends Paypal
{
    public function execute(): Payment
    {
        $payment = $this->GetThePayment();

        // echo "<pre>"; print_r($paymentId); exit();

        $execution = $this->CreateExecution();

        //
        $execution->addTransaction($this->Transaction());
        // echo "<pre>"; print_r($res); exit();

        try{
            $result = $payment->execute($execution, $this->apiContext);
            // echo "<pre>"; print_r($result); exit();
            if ($result->getState() == 'approved') {
                $invoiceId = $result->transactions[0]->InvoiceId();
                Session::put('invoice_id', $invoiceId);

                echo "<pre>"; print_r($invoiceId);
            }
        }catch (Exception $ex) {
            exit(1);
        }
        return $result;
    }

    /**
     * @return Payment
     */
    protected function GetThePayment(): Payment
    {
        $paymentId = Session::get('paymentId');
//        $paymentId = request('paymentId');
        return Payment::get($paymentId, $this->apiContext);
    }

    /**
     * @return PaymentExecution
     */
    protected function CreateExecution(): PaymentExecution
    {
        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));
        return $execution;
        // echo "<pre>"; print_r($payerId); exit();
    }

    /**
     * @return Details
     */
    protected function Details(): Details
    {
        $subTotal = Session::get('Subtotal');
        $tax = Session::get('Tax');
        $details = new Details();
        $details->setShipping(0)
            ->setTax($tax)
            ->setSubtotal($subTotal);
        return $details;
        // echo "<pre>"; print_r($details); exit();
    }

    /**
     * @return Amount
     */
    protected function Amount(): Amount
    {
        $GrandTotal = Session::get('cartTotal');
        $amount = new Amount();
        $amount->setCurrency('USD');
        $amount->setTotal($GrandTotal);
        $amount->setDetails($this->Details());
        return $amount;
    }

    /**
     * @return Transaction
     */
    protected function Transaction(): Transaction
    {
        $transaction = new Transaction();
        $transaction->setAmount($this->Amount());
        return $transaction;
    }
}

