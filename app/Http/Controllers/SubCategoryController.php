<?php

namespace App\Http\Controllers;

use App\Models\Category;
// use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index() {}
    /**
     * Display a Subcategory from catyegory table.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_subcategory()
    {
        //
        $subcategory = Category::where('parent_id', '!=', NULL)->get();
        return response()->json([
            'subcategories' => $subcategory
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subCatBy_CatId($id)
    {
        //
        $subcategory = Category::where('parent_id', '=', $id)->get(); 
        return response()->json([
            'subcatBycId' => $subcategory
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        //Fom validation
        $this->validate( $request, [
          'name' => 'required|min:5|max:50',
          'parent_id' => 'required',
          'url' => 'required'
        ]);
        //
        $subcategory = new Category();
        $subcategory->name = $request->name;
        $subcategory->parent_id = $request->parent_id;
        $subcategory->url = $request->url;
        $subcategory->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request, $id)
    {
        //
        $subcategory = category::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function unpublish(Request $request, $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // return $request->all();
        $this->validate( $request, [
            'name' => 'required|min:5|max:50',
            'parent_id' => 'required',
            'url' => 'required'
          ]);
        //
        $subcategory = Category::findOrFail($id);
        $subcategory->name = $request->name;
        $subcategory->parent_id = $request->parent_id;
        $subcategory->url = $request->url;
        $subcategory->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($subcategory)
    {
        //
    }

}
