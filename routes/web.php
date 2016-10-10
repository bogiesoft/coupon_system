<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/generatecode', [
	'as' => 'generatecode',
	'uses' => 'GenerateCouponCodeController@index'
]);

Route::resource('campaigns', 'CouponCampaignController');

Route::post('stocks/checkstock', [
	'as' => 'stocks.checkstock',
	'uses' => 'CouponStockController@checkStock'
]);
Route::post('stocks/checkstock', [
	'as' => 'stocks.checkstock',
	'uses' => 'CouponStockController@checkStock'
]);
Route::resource('stocks', 'CouponStockController');

Route::get('redeems/addpoint', [
	'as' => 'redeems.addpoint',
	'uses' => 'CouponRedeemController@addUserPoints'
]);
Route::get('redeems/report', [
	'as' => 'redeems.report',
	'uses' => 'CouponRedeemController@showUserReport'
]);
Route::resource('redeems', 'CouponRedeemController');