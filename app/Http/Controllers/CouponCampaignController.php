<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\CouponCampaign as CouponCampaign;

class CouponCampaignController extends Controller
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
    public function index(CouponCampaign $couponCampaign)
    {
        $couponCampaigns = $couponCampaign
        					->get();
		$dataToView = [
			'couponCampaigns' => $couponCampaigns
		];

		return view('showCouponCampaignList', $dataToView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('createCouponCampaign');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon_campaign = new CouponCampaign;
        $coupon_campaign->name = $request->name;

        $codechar = str_random(2);
        $coupon_campaign->codechar = $codechar;

    	if($request->type == 'maxuse'){
    		if($request->has('maxuse_amount')) {
    			$coupon_campaign->maxuse = $request->maxuse_amount;
    		}
    	}elseif($request->type == 'points'){
			if($request->has('points_amount')) {
    			$coupon_campaign->points = $request->points_amount;
    		}
    	}

		$coupon_campaign->type = $request->type;

        $coupon_campaign->save();

        return redirect()->route('campaigns.index');
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
}
