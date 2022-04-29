<?php

namespace App\Http\Controllers;

use Image;
use App\Models\User;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory; 
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /*  ===========****** //End Of Constructor Section  ********========    */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.index');       
    }


    /**
     * SuperAdmin for Managing Categories with various activity
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_category()
    {
        //
        $category = Category::where('parent_id', 0)->get();
        return response()->json([
            'categories' => $category
        ]);
    }

    /*  ===========****** //End Of Category Activity Section  ********========    */

    /**
     * SuperAdmin for Managing SubCategories with various activity
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_subcategory()
    {
        //
        $subcategory = Category::where('parent_id', '!=', 0)->get();
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

    /*  ===========****** //End Of SubCategory Activity Section  ********========    */

    /**
     * SuperAdmin for Managing Products with various activity
     * like Add, Edit, Publish, Unpublish, Update and Delete
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function add_product(Request $request)
    {
        return $request->all();
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
     * Show the form for editing the specified Product.
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
     *  Fetch product by product Id
     */
    public function get_image($id) {
        //
        $product = Product::findOrFail($id);
        return response()->json([
            'proimage' => $product
        ]);
    }


    /**
     * Fetch product attributes from product_attribute table 
     * by product id
     */
    public function productAttributes($id) {

        $product = Product::findOrFail($id);
        // echo $product->id;die;

        $proAttributes = ProductAttribute::with('product')->where('product_id', $product->id)->get();
        // echo $proAttributes,die;
        return response()->json([
            'attributes' => $proAttributes
        ]);
    } 


  /*  ===========****** //End Of Product Activity Section  ********========    */



    /**
     * Fetch All Seller details from Seller Table
     */
    public function all_seller() {
        $sellers = Seller::all();
        return response()->json([
            'sellers' => $sellers
        ], 200);
    }

    /**
     * Fetch All Customers details from User Table
     */
    public function all_user() {
        $users = User::all();
        return response()->json([
            'users' => $users
        ], 200);
    }


}
