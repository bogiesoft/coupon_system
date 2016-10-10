<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponStock extends Model
{
    protected $table = 'coupon_stocks';

    protected $fillable = [
        'campaign_id', 'code', 'status',
    ];
}
