<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\CouponRedeem as CouponRedeem;

use App\User as User;

class CouponRedeemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showUserReport(CouponRedeem $couponRedeem, User $user)
    {
        $reports = $couponRedeem
                    ->selectRaw('sum(point_change) as points, user_id')
                    // ->where('point_change', '<', 0)
                    ->groupBy('user_id')
                    ->join('users', 'users.id', '=', 'user_id')
                    ->get();
                    
        $users = $user
                ->get();
        $dataToView = [
            'reports' => $reports,
            'users' => $users
        ];
        return view('showUserReport', $dataToView);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CouponRedeem $couponRedeem)
    {

        $redeems = $couponRedeem
                    ->get();
        $dataToView = [
            'redeems' => $redeems
        ];

        return view('showRedeemReport', $dataToView);
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
    public function store(Request $request)
    {

        $coupon_redeem = new CouponRedeem;
        $coupon_redeem->user_id = $request->user_id;

        if($request->has('coupon_id')) {
            $coupon_redeem->coupon_id = $request->coupon_id;
        } else {
            // $coupon_redeem->coupon_id = NULL;

        }
        
        $coupon_redeem->point_change = $request->point_change;
        // return 'fuk';
        $saved = $coupon_redeem->save();

        if(!$saved) {
            return 'error';
        }

        return 'success';
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

    public function addUserPoints(User $user)
    {

        $users = $user
                 ->get();

        $dataToView = [
            'users' => $users
        ];

        return view('addUserPoints', $dataToView);
    }
}
