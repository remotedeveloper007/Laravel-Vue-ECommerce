<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    use HasFactory;

    protected $guarded = [];
 
    /**
     * specify the one-to-one relationship between Userand VerifyUserModel.
     */
    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User', 'user_id');
    // }     
}
