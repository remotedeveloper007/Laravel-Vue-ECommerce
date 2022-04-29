<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategory()
    {
        //
        $category = Category::where('parent_id', '==', 0)->get();

        return response()->json([
            'categories' => $category
        ], 200);
    }
    /**
     * 
     */
    public function getSubcategory()
    {
        //
        $subcategory = Category::where('parent_id', '!=',  0)->get();
        return response()->json([
            'subcategories' => $subcategory
        ], 200);
    }
    /**
    * 
    */
    public function getProduct() {
        $product = Product::inRandomOrder()->where('status', 1)->limit(12)->get();

        return response()->json([
            'fetchProducts' => $product
        ], 200);
    } 
    /**
     * 
     */
    public function getAttributes($id)
    {
        $attribute = ProductAttribute::where('product_id', $id)->get();
        // echo $attribute;die;

        return response()->json([
            'attributes' => $attribute
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getProductByCategory($url = null)
    {
        $countCategory = Category::where(['url' => $url])->count();
        // echo $countCategory;die;
        if($countCategory==0){
            // abort(404);
            return view('public.404');
        }
        //
        $catpro = Category::with('subcategory')->where(['url' => $url])->first();
        $parent_id = $catpro->parent_id;

        $allProducts = Product::with('category')->where(['category_id' => $catpro->id])->where('status', 1)->get();
        // echo $allProducts;die;

        if($catpro->parent_id == 0) {
            //if url is from category url i.e. parent_id == 0
            $allProducts = Product::with('category')->where(['category_id' => $catpro->id ])->where('status', 1)->get();
            // echo $allProducts;die;
        } else {
            //if url is from subcategory url i.e. parent_id != 0
            $allProducts = Product::with('category')->where(['subcategory_id' => $catpro->id, 'category_id' => $parent_id ])->where('status', 1)->get();
            // echo $allProducts; die;
        }

        return response()->json([
            'catproducts' => $allProducts
        ], 200);

    } 
    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getProductBySubcat($url = null)
    {
        //
        $subcat = Category::with('subcategory')->where(['url' => $url])->first();
        // echo $subcat->parent_id; die;

        $parent_id = $subcat->parent_id;
        // echo $parent_id; die;

        // If url from sub category i.e != null
        $allProducts = Product::with('category')->where(['subcategory_id' => $subcat->id, 'category_id' => $parent_id ])->get();
        //  echo $allProducts; die;

        return response()->json([
            'subcatproducts' => $allProducts
        ], 200);
    }

    /**
     * Display Single Product for Product Details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductById($id)
    {
        $product = Product::findOrFail($id);

        //Show 404 error page when product publish status == 0
         $productCount = Product::where(['id'=> $id, 'status'=>1])->count();
          if($productCount == 0) {
            //   abort(404);
            return view('public.404');
          }

        //
        // $product = Product::findOrFail($id);
        $product = Product::where('id', $id)->first();
        // $product = json_decode(json_encode($product));
        // echo "<pre>"; print_r($product); exit();

        $relatproduct = Product::where('id', '!=', $id)->where(['category_id' => $product->category_id])->get();
        /*  foreach($relatproduct->chunk() as $chunk) {
              foreach($chunk as $item) {
                  echo $item; echo "<br>";
              }
              echo "<br><br><br>";
          }  */
        // echo "<pre>";print_r($relatproduct);exit();
        
        return response()->json([
            'productById' => $product,
            'recommendedProducts' => $relatproduct
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProduct_Price_By_Size($id, $size)
    {
        //
        $proAttribute = ProductAttribute::where(['product_id' => $id, 'size' => $size])->first();
        // return $proAttribute;

        return response()->json([
            'price' => $proAttribute
        ], 200);
    }
    
    /**
     * Get product stock count 
     */
    public function stock($id) {
        $total_stock = ProductAttribute::where('product_id', $id)->sum('stock');
        // return $total_stock;

        return response()->json([
            'stock' => $total_stock
        ], 200);
    } 
    
    
}
