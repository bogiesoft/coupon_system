<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('codechar')->unique();
            $table->string('type');
            $table->integer('maxuse')->default(10)->unsigned();;
            $table->integer('points')->default(10)->unsigned();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coupon_campaigns');
    }
}
