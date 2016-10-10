<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\MasterConfig as MasterConfig;

use App\Http\Controllers\CouponStockController as CouponStockController;

class GenerateCouponCodeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
		if($request->has('id') &&  $request->has('codechar')) {
			$codechar = $request->codechar;
		}else{
			
			$dataToView = [
				'error' => 'invalid'
			];	

			return view('showCouponCampaignList', $dataToView);
		}

		$masterConfig = new MasterConfig;
		$config = $masterConfig
					->where('codechar', $codechar)
					->get();

		if(count($config) == 0) {
			$coupon_inc = '0001';

			//create new record
			$masterConfig->codechar = $codechar;
			$masterConfig->coupon_inc = $coupon_inc;
			$masterConfig->save();
		} else {
			$coupon_inc_prev = $config[0]->coupon_inc;
			$coupon_inc_int = intval($coupon_inc_prev) + 1;
			$coupon_inc = str_pad($coupon_inc_int, 4, '0', STR_PAD_LEFT);

			//update record
			$config[0]->coupon_inc = $coupon_inc;
			$config[0]->save();
		}

		$code = $codechar . $coupon_inc;

		//call store method in CouponStockController
		$couponStockController = new CouponStockController;
		$couponStockController->store($request, $code);

		return $code;
    }
}
