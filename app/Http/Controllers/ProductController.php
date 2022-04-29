<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Product;  //use Product model here
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
        
    public function index() {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_products()
    {
        /**
         * Get method (seller,brand,category, and subcategory) 
         * define in Product Model to fetch all Products releted
         * to this defind method
         */
        $products = Product::with('category')->get();
        return response()->json([
            'products' => $products
        ]);
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
        // return $request->all();
        $this->validateProduct();
         
        /**
         * Format product_image and save at product_image
         * public folder
         */    
        $strpos = strpos($request->product_image, ';');
        $sub = substr($request->product_image, 0, $strpos);
        $exe = explode('/', $sub) [1];
        $image_name = time().".".$exe;
        $img = Image::make($request->product_image)->resize(200, 200); 
        $upload_path = public_path()."/product_image/"; 
        $img->save($upload_path.$image_name);
        /**
         * Save Form Product Dateils into database products table
         */
        $product = new Product();
        $product->product_name = $request->product_name;
        // $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->product_code = $request->product_code;
        $product->product_price = $request->product_price;
        $product->product_color = $request->product_color;
        // $product->product_quantity = $request->product_quantity;
        $product->description = $request->description;
        $product->seller_id = 1;
        $product->status = 1;
        $product->product_image = $image_name;
        $product->save();

    }

    /**
     * Publish the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {    $product = Product::findOrFail($id);
        //
        $product->status = 1;
        $product->save();
    }
    
    /**
     * Publish the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function unpublish($id)
     {
         $product = Product::findOrFail($id);
         //
         $product->status = 0;
         $product->save();
     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);
        return response()->json([
            'product' => $product
        ]);
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
        $product = Product::findOrFail($id);
        //
        $this->validateProduct();
       /**
         * Format product_image and Update at product_image
         * public folder and remove old image from folder
         */ 
        if($request->product_image != $product->product_image) {
            $strpos = strpos($request->product_image, ';');
            $sub = substr($request->product_image, 0, $strpos);
            $exe = explode('/', $sub) [1];
            $imagename = time().".".$exe;
            $img = Image::make($request->product_image)->resize(200, 200);
            $upload_image = public_path()."/product_image/";
            $image = $upload_image.$product->product_image;
            $img->save($upload_image.$imagename);

              if(file_exists($image)) {
                  @unlink($image);
              }

          } else {
             $imagename = $product->product_image; 
          }
         
        /**
         * Update Product into database with respect to productId
         */
        $product->product_name = $request->product_name;
        // $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->product_code = $request->product_code;
        $product->product_price = $request->product_price;
        $product->product_color = $request->product_color;
        // $product->product_quantity = $request->product_quantity;
        $product->description = $request->description;
        $product->seller_id = 1;
        $product->status = 1;
        $product->product_image = $imagename;
        $product->save();        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $product = Product::findOrFail($id);
        //
        $image_path  = public_path()."/product_image/";
        $image = $image_path.$product->product_image;
        if(file_exists($image)){
            @unlink($image);
        }
        $product->delete();
    }

    /**
     * 
     */
    public function productAttributes($id) {

        $product = ProductAttribute::with('product')->where('product_id', $id)->get();
        return response()->json([
            'attributes' => $product
        ]);
    }
    /**
     * 
     */
    public function addAtributes(Request $request, $id) {       
        $attribute = new ProductAttribute();
        $attribute->product_id = $id;
        $attribute->sku = $request->sku;
        $attribute->size = $request->size;
        $attribute->price = $request->price;
        $attribute->stock = $request->stock;
        $attribute->save();
    }
    /**
     * 
     */
    protected function validateProduct() {
        return request()->validate([
            'product_name' => 'required',
            // 'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_image' => 'required',
            'product_code' => 'required',
            'product_price' => 'required',
            'product_color' => 'required',
            // 'product_quantity' => 'required',
            'description' => 'required|min:5|max:100'
        ]);
    }
}
