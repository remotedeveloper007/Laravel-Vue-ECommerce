<?php


namespace App\Paypal;

/** Paypal Details classes **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class Paypal
{
    protected $apiContext;
    public function __construct()
    {
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'Aa7x95osIZr7uY7raa-nhjxIlF8lXyFF3etHd4R_PeaCT89mqUkuBNOOHWOU0xLYZseBYUTGuI-ZzA12',     // ClientID
                'EKvjGF5PQMaM78xAsTM4J5AsvGPBi7aUvWVVQ2yt0qUluY9bK1JXjGgzdnNxsb4e8qVIPc1XRl6JYWYN'      // ClientSecret
            )
        );
    }

}
