<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCoupons()
    {
        //
        $coupon = Coupon::all();
        return response()->json([
            'coupon' => $coupon
        ],200);
    }

    /**
     * Store a newly created Coupon in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateCoupon();
        //
        $coupon = new Coupon();
        $coupon->coupon_code = $request->coupon_code;
        $coupon->amount      = $request->amount;
        $coupon->amount_type = $request->amount_type;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->status      = $request->status;
        $coupon->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $coupon = Coupon::findOrFail($id);
        //
        $coupon->status = 1;
        $coupon->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $coupon = Coupon::findOrFail($id);
        //
        $coupon->status = 0;
        $coupon->save(); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateCoupon();
        //
        $coupon = Coupon::findOrFail($id);
        $coupon->coupon_code = $request->coupon_code;
        $coupon->amount      = $request->amount;
        $coupon->amount_type = $request->amount_type;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->status      = $request->status;
        $coupon->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        //
        $coupon->delete();
    }


    protected function validateCoupon(){
        return request()->validate([
           'coupon_code' => 'required|alpha_num|min:6|max:15|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
           'amount'      => 'required|numeric|min:1',
           'amount_type' => 'required',
           'expiry_date' => 'required',
           'status'      => 'required'
        ]);
    }
}
