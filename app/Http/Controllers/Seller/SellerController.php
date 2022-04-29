<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:seller');
    }
    /**
     * Show Admin Dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('seller.seller_home');
    }    
}
