<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponCampaign extends Model
{
    protected $table = 'coupon_campaigns';

    protected $fillable = [
        'name', 'codechar', 'type', 'maxuse', 'points',
    ];
}
