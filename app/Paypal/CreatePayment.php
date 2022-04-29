<?php


namespace App\Paypal;


use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Payment;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

use Session;

class CreatePayment extends Paypal
{
    public function create(): Payment
    {
        # We get all the items from the cart and parse the array into the Item object
        $userCart = DB::table('carts')->where(['user_id' => Auth::user()->id, 'user_email' => Auth::user()->email])->get();
        $items = [];
        foreach($userCart as $product) {
            // #code..
            $i=0; $sum = 0; $tax = 0;

            $sum = $sum + ($product->price * $product->quantity);
            $tax       =  ($sum * 18 / 100);

            $item = new Item();
            $item->setName($product->product_name)
                ->setCurrency('USD')
                ->setQuantity($product->quantity)
                ->setSku($product->product_code) // Similar to `item_number` in Classic API
                ->setPrice($product->price)
                ->setTax($tax);

                array_push($items, $item);
            $i++;
        }
        # We create a new item list and assign the items to it
        $itemList = new ItemList();
        $itemList->setItems($items);

//        echo "<pre>";print_r($itemList);exit();

        $payment = $this->Payment($itemList);

        // echo "<pre>"; print_r($payment); exit();

        try {
            $payment->create($this->apiContext);

        } catch (Exception $ex) {
            exit(1);
        }
        $approvalUrl = $payment->getApprovalLink();

        # We store the payment ID into the session
        Session::put('paymentId', $payment->getId());

        return $payment;
    }

    /**
     * @return Payer
     */
    protected function Payer(): Payer
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        return $payer;
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
    }

    /**
     * @return Amount
     */
    protected function Amount(): Amount
    {
        $GrandTotal = Session::get('cartTotal');
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($GrandTotal)
            ->setDetails($this->Details());
        return $amount;
    }

    /**
     * @param ItemList $itemList
     * @return Transaction
     */
    protected function Transaction(ItemList $itemList): Transaction
    {
        $transaction = new Transaction();
        $transaction->setAmount($this->Amount())
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
        return $transaction;
    }

    /**
     * @return RedirectUrls
     */
    protected function RedirectUrls(): RedirectUrls
    {
//        $baseUrl = getBaseUrl();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://localhost:8000/user/payment-status")
            ->setCancelUrl("http://localhost:8000/user/payment-status");
        return $redirectUrls;
    }

    /**
     * @param $itemList
     * @return Payment
     */
    protected function Payment($itemList): Payment
    {
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($this->Payer())
            ->setRedirectUrls($this->RedirectUrls())
            ->setTransactions([$this->Transaction($itemList)]);
        return $payment;
    }

}

