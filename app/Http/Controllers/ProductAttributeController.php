<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    //
    /**
     * Add product Attributes into product attribute table
     */
    public function addAtributes(Request $request, $id) {

        //Form validation check for Attributes
            $this->validate($request, [
               'sku' => 'required|unique:product_attributes',
            ]);
   
            $attrCountSize = ProductAttribute::where(['product_id' => $id, 'size' => $request->size])->count();
            if($attrCountSize > 0) {
                     $this->validate($request, [
                    'size' => 'unique:product_attributes', 
               ]);
            }
            $this->validate($request, [
               'size' => 'required',
               'price' => 'required',
               'stock' => 'required'
            ]);
   
         $attribute = new ProductAttribute();
         $attribute->product_id = $id;
         $attribute->sku = $request->sku;
         $attribute->size = $request->size;
         $attribute->price = $request->price;
         $attribute->stock = $request->stock;
       
        //  return $attribute;
   
         $attribute->save();
       }    
       
    /**
     * Update the Product Attribute in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
      * @return \Illuminate\Http\Response
    */
    public function update_attribute(Request  $request,$id) {
      $attribute = ProductAttribute::findOrFail($id);

      $attribute->price = $request->price;
      $attribute->stock = $request->stock;
      $attribute->save();
    }

    /**
     * Update the Alternate image from Product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_altImage(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        //
        // $this->validateProduct();
       /**
         * Format product_image and Update at product_image
         * public folder and remove old image from folder
         */ 
        if($request->alternate_image1 != $product->alternate_image1 && $request->alternate_image2 != $product->alternate_image2){
            $strpos1 = strpos($request->alternate_image1, ';');
            $strpos2 = strpos($request->alternate_image2, ';');
            $sub1 = substr($request->alternate_image1, 0, $strpos1);
            $sub2 = substr($request->alternate_image2, 0, $strpos2);
            $exe1 = explode('/', $sub1) [1];
            $exe2 = explode('/', $sub2) [1];
            $imagename1 = time()."a".".".$exe1;
            $imagename2 = time()."b".".".$exe2;
            $img1 = Image::make($request->alternate_image1)->resize(200, 200);
            $img2 = Image::make($request->alternate_image2)->resize(200, 200);
            $upload_image1 = public_path()."/product_image/";
            $upload_image2 = public_path()."/product_image/";
            $image1 = $upload_image1.$product->alternate_image1;
            $image2 = $upload_image2.$product->alternate_image2;
            $img1->save($upload_image1.$imagename1); 
            $img2->save($upload_image2.$imagename2);            
              if(file_exists($image1)){
                if(file_exists($image2)) {
                    @unlink($image1);
                    @unlink($image2);
                }                 
              }
          } else {
             $imagename1 = $product->alternate_image1; 
             $imagename2 = $product->alternate_image2;
          }
        /**
         * Update Product Alternate Images into database with respect to productId
         */
        //  return $product;
        $product->alternate_image1 = $imagename1;
        $product->alternate_image2 = $imagename2;
        $product->save();        
    }


}
