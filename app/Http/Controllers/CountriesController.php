<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\country;
use Illuminate\Http\Request;

class CountriesController extends Controller
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
    public function Countries()
    {
        //
        $country = Country::get();
        // echo "<pre>"; print_r($country); exit();

        return response()->json([
            'countries' => $country
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function States($id)
    {
        //
        $state = State::where('country_id', $id)->get();

        return response()->json([
            'states' => $state
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function Cities($id)
    {
        //
        $city = City::where('state_id', $id)->get();

        return response()->json([
            'cities' => $city
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(country $country)
    {
        //
    }
}
