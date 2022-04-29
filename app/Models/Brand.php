<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * A Brand may has many product to sell but
     * Get the products related to the brand.
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }    
}
