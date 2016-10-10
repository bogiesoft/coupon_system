<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponRedeem extends Model
{
    protected $table = 'coupon_redeems';

    protected $fillable = [
        'user_id', 'coupon_id', 'point_change',
    ];
}
