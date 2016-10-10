<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterConfig extends Model
{
	protected $table = 'master_config';

    protected $fillable = [
        'coupon_inc', 'code_digit',
    ];
}
