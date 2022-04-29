<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Product belongsTo which Seller
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    /**
     * A Brand may has many product to sell but
     * a single product must relate to only a particular brand
     * Get the brand that owns this product
     */
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    /**
     * Product belongsTo which category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Product belongsTo which subcategory
     */
    public function subcategory()
    {
        return $this->belongsTo('App\SubCategory');
    }

    /**
     *  Create One to Many Relation with ProductAttribute table
     */
    public function attributes() {
       return $this->hasMany('App\ProductAttribute', 'product_id');
    }
    /**
     * 
     */
    public function orders(){
        return $this->hasMany(Order::class);
    }    
}
