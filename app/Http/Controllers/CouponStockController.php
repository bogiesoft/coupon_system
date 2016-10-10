<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\CouponStock as CouponStock;

use App\CouponCampaign as CouponCampaign;

use App\User as User;

use App\CouponRedeem as CouponRedeem;

use App\Http\Controllers\CouponRedeemController as CouponRedeemController;

class CouponStockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($msg);

        // if($msg == '') {
        //    return view('redeemCoupon'); 
        // }

        // $dataToView = [
        //     'error' => 'invalid',
        //     'msg' => $msg
        // ];

        return view('redeemCoupon');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $code)
    {
        $coupon_stock = new CouponStock;
        $coupon_stock->campaign_id = $request->id;
        $coupon_stock->code = $code;
        $coupon_stock->status = "active";
        $coupon_stock->save();
        return redirect()->route('stocks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkStock(Request $request)
    {
        if($request->has('code') && $request->has('user_id')) {
            $code = $request->code;
            $user_id = $request->user_id;
        } else {

            return redirect()->back()->with('error', 'Please try again.');

        }

        $couponStocks = new CouponStock;
        $couponStock = $couponStocks
                        ->where('code', $code)
                        ->get();

        //if stock does not exist, return error data
        if(count($couponStock) == 0) {

            return redirect()->back()->with('error', 'Please make sure you input a valid code.');

        } elseif($couponStock[0]->status == 'used' || $couponStock[0]->status == 'suspended') {

            return redirect()->back()->with('error', 'This code has been used, please use other valid code to redeem.');
        }

        $coupon_id = $couponStock[0]->id;
        $campaign_id = $couponStock[0]->campaign_id;

        //query from coupon campaign with specific id

        $couponCampaigns = new CouponCampaign;
        $couponCampaign = $couponCampaigns
                            ->where('id', $campaign_id)
                            ->get();

        if(count($couponCampaign) == 0) {

            return redirect()->back()->with('error', 'Please contact adminstrator.');

        }

        $type = $couponCampaign[0]->type;

        $point_change = 0;

        //check whether user as enough point or available usage
        if($type == 'points') {
            $points_require = $couponCampaign[0]->$type;
            $couponRedeem = new CouponRedeem;
            $user_points = $couponRedeem
                        ->where('user_id', $user_id)
                        ->sum('point_change');


            //check whether user has enough points
            if($user_points < $points_require) {

                return redirect()->back()->with('error', 'Not enough points to redeem this code.');
                
            } else {
                $point_change = -$points_require;

            }
        } else {
            $max_usage = $couponCampaign[0]->$type;

            $user_usage = $couponStocks
                            ->where('campaign_id', $campaign_id)
                            ->where('status', 'used')
                            ->count();


            //check whether user has reached maximum usage this coupon
            if($user_usage >= $max_usage) {

                return redirect()->back()->with('error', 'This coupon has reached its maximum usage.');
            }

        }

        $request->request->add(['coupon_id' => $coupon_id]);
        $request->request->add(['point_change' => $point_change]);

        $couponRedeemController = new CouponRedeemController;
        $saved = $couponRedeemController->store($request);

        if(!$saved) {

            return redirect()->back()->with('error', 'Please try again.');
        }

        //update status
        $couponStock[0]->status = 'used';
        $couponStock[0]->save();

        return redirect()->back()->with('success', 'This coupon is redeemed successfully');
    }
}