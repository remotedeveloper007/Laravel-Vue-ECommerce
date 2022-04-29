<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 *  Routing for Admin login to be manage in LoginController
 */
    Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.logout');
    
    

    
Route::group(['middleware' => 'auth:admin'], function() {    
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.dashboard');

    /**
     * Route to manage User by Admin in AdminController
     */
    Route::get('/user', [App\Http\Controllers\SuperAdminController::class, 'all_user'])->name('admin.users');
    Route::get('/block/{any}', [App\Http\Controllers\Admin\AdminController::class, 'block_user']);
    Route::get('/unblock/{any}', [App\Http\Controllers\Admin\AdminController::class, 'unblock_user']);

    /**
     * Route to manage Seller by Admin in AdminController
     */
    Route::get('/sellers', [App\Http\Controllers\SuperAdminController::class, 'all_seller'])->name('admin.seller');
    Route::get('/block-seller/{any}', [App\Http\Controllers\Admin\AdminController::class, 'block_seller']);
    Route::get('/unblock-seller/{id}', [App\Http\Controllers\Admin\AdminController::class, 'unblock_seller']); 
    
    /**
     * The following Route for Category are maintained in SuperAdminController
     */
    Route::get('/category', [App\Http\Controllers\SuperAdminController::class, 'all_category']);
    // Route::get('/edit-category/{id}', 'SuperAdminController@editCategory');
 
    /**
     * The following Route for Category are maintained in CategoryController
     */    
    Route::post('/add-category', [App\Http\Controllers\CategoryController::class, 'store'])->name('admin.add-category');
    Route::get('/publish-category/{id}', [App\Http\Controllers\CategoryController::class, 'publish']);
    Route::get('/unpublish-category/{id}', [App\Http\Controllers\CategoryController::class, 'unpublish']);
    Route::post('/update-category/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
    Route::get('/delete-category/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
    
    
    /**
     * The following Route for Subcategory are maintained in SuperAdminController
     */
    Route::get('/subcategory',[App\Http\Controllers\SuperAdminController::class, 'all_subcategory']);
    Route::get('/subcatOfcId/{any}', [App\Http\Controllers\SuperAdminController::class, 'subCatBy_CatId'])->where(['id' => '[0-9]+']);
    // Route::get('/edit-subcategory/{id}','SuperAdminController@edit');

    /**
     * The following Route for Subcategory are maintained in SubCategoryController
     */
    Route::post('/add-subcategory', [App\Http\Controllers\SubCategoryController::class, 'store']);
    Route::get('/publish/{id}', [App\Http\Controllers\SubCategoryController::class, 'publish']);
    Route::get('/unpublish/{id}', [App\Http\Controllers\SubCategoryController::class, 'unpublish']);
    Route::post('/update-subcategory/{id}', [App\Http\Controllers\SubCategoryController::class, 'update']);
    Route::get('/delete-subcategory/{id}', [App\Http\Controllers\SubCategoryController::class, 'destroy']);
   
 
    /** 
     * The following Route for Product are maintained in SuperAdminController
     */  
    Route::get('/products', [App\Http\Controllers\SuperAdminController::class, 'all_products']);
    Route::get('/editProduct/{id}', [App\Http\Controllers\SuperAdminController::class, 'edit'])->where(['id' => '[0-9]+']);
    Route::get('/productImage/{id}', [App\Http\Controllers\SuperAdminController::class, 'get_image'])->where(['id' => '[0-9]+']);

    /**
     * The following Route for Product are maintained in ProductController
     */
    // Route::POST('/add-product', 'SuperAdminController@add_product')->name('admin.add-product');
    Route::post('/addProduct', [App\Http\Controllers\ProductController::class, 'store']);
    Route::get('/publish-product/{id}', [App\Http\Controllers\ProductController::class, 'publish']);
    Route::get('/unpublish-product/{id}', [App\Http\Controllers\ProductController::class, 'unpublish']);   
    Route::post('/update-product/{id}', [App\Http\Controllers\SuperAdminController::class, 'update']);    
    Route::get('/delete-product/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);  

    /** 
     * Maintain Route for Product Attributes here in ProductAttributeController
     */
    Route::get('/attribute/{id}', [App\Http\Controllers\SuperAdminController::class, 'productAttributes'])->where(['id' => '[0-9]+']);
    Route::post('/save-attribute/{id}', [App\Http\Controllers\ProductAttributeController::class, 'addAtributes']); 
    Route::post('/update-attribute/{id}', [App\Http\Controllers\ProductAttributeController::class, 'update_attribute']);

    Route::post('/update-altimage/{id}', [App\Http\Controllers\ProductAttributeController::class, 'update_altImage']);
    
    /**
     * Maintain Route for Discount Coupons
     */
    Route::get('/coupon', [App\Http\Controllers\CouponController::class, 'getCoupons']);
    Route::post('/addCoupon', [App\Http\Controllers\CouponController::class, 'store']);
    Route::get('/publish-coupon/{id}', [App\Http\Controllers\CouponController::class, 'activate']);
    Route::get('/unpublish-coupon/{id}', [App\Http\Controllers\CouponController::class, 'deactivate']);
    Route::post('/updateCoupon/{id}', [App\Http\Controllers\CouponController::class, 'update']);
    Route::get('/delete-coupon/{id}', [App\Http\Controllers\CouponController::class, 'destroy']);

    /**
     * Maintain Route for managing Banner
     */
    Route::match(['get', 'post'], '/banner', [App\Http\Controllers\BannerController::class, 'store']);   
    
    /**
     * Routing For Frontend Admin Content Display 
     * Maintane Route for Brand
     */
    Route::post('/add-brand', [App\Http\Controllers\BrandController::class, 'store']);
    Route::get('/brand', [App\Http\Controllers\BrandController::class, 'all_brands']);
    Route::get('/publish-brand/{id}', [App\Http\Controllers\BrandController::class, 'publish']);
    Route::get('/unpublish-brand/{id}', [App\Http\Controllers\BrandController::class, 'unpublish']);
    // Route::get('/edit-brand/{id}', 'BrandController@edit');
    Route::post('/update-brand/{id}', [App\Http\Controllers\BrandController::class, 'update']);
    Route::get('delete-brand/{id}', [App\Http\Controllers\BrandController::class, 'delete']); 
    
    /**
     * Route for Managing Order by Admin
    */
    Route::get('/view-order', [App\Http\Controllers\OrderController::class, 'getOrder']);
    Route::get('/view-order/{any}', [App\Http\Controllers\OrderController::class, 'getOrderDetails']);
    Route::get('/get-detail/{any}', [App\Http\Controllers\OrderController::class, 'otherDetailsByorderId']);
    Route::post('/update-status/{any}', [App\Http\Controllers\OrderController::class, 'updateOrderStatus']);
});

Route::get('/{anypath}', [App\Http\Controllers\Admin\AdminController::class, 'index'])->where('anypath', '([A-z\d\-\/_.]+)?');

