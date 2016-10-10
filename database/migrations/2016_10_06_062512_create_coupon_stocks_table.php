<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_stocks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('campaign_id')->unsigned();
            $table->foreign('campaign_id')->references('id')->on('coupon_campaigns');
            
            $table->string('code')->unique();
            $table->string('status');
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
        Schema::drop('coupon_stocks');
    }
}
