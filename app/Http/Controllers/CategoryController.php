<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_category()
    {
        //
        $category = Category::where('parent_id',NULL)->get();
        return response()->json([
            'categories' => $category
        ]);
    }

    /**
     * Get the List of category by parent_id
     *
     * @return \Illuminate\Http\Response
     */
    // public function mainCats()
    // {
    //     //
    //     $levels = Category::where('parent_id',NULL)->get();
    //     return response()->json([
    //         'mainCategories' => $levels
    //     ], 200);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Fom validation
        $this->validate( $request, [
           'name' => 'required|min:5|max:50'
        ]);
        
        // $data = $request->all();
        // echo '<pre>';print_r($data);exit();
        /**
         * Create New catrgory instance
         */
        $category = new Category();
        $category->name = $request->name;
        $category->url = $request->url;
        $category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request, $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->status = 1;
        $category->save();
    }

    /**
     * Hide the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function unpublish(Request $request, $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->status = 0;
        $category->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->url = $request->url;
        $category->save(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::findOrFail($id);
        $category->delete();
    }
}
