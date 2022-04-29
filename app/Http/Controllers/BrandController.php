<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index() {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_brands()
    {
        //
        $brands = Brand::all();
        return response()->json([
           'brands' => $brands
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'brand_name' => 'required|min:5|max:50'
          ]);
        //
        // $brand = new Brand();
        // $brand->brand_name = $request->brand_name;
        // $brand->publication_status = 1;
        // $brand->save();
        return ['message' => 'Brand Added'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        $brand = Brand::findOrFail($id);
        //
        $brand->publication_status = 1;
        $brand->save();
    }

    /**
     * UnPublished the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function unpublish($id)
    {
        $brand = Brand::findOrFail($id);
        //
        $brand->publication_status = 0;
        $brand->save();
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response 
     */
    public function update(Request $request,$id)
    {
        $brand = Brand::findOrFail($id);
        //
        $this->validate($request, [
            'brand_name' => 'required|min:5|max:50'
          ]);
        // $brand->brand_name = $request->brand_name;
        // $brand->save();  

        return ['message' => 'Brand Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $brand = Brand::findOrFail($id);
        $brand->delete();
        // return ['message' => "Brand Deleted"];

    }
}
