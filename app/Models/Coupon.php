<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public static function findByCode($code) {
        return self::where('coupon_code', $code);
    }

    public function discount($total) {
        if($this->amount_type = 'Fixed') {
           return $this->amount;
        } elseif ($this->amount_type = 'Percentage') {
           return ($this->percent_off / 100) * $total;
        } else {
            return 0;
        }
    }    
}
