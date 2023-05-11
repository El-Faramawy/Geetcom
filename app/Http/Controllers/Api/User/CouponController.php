<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    use WithRelationTrait, PaginateTrait;
    public function current_coupons(Request $request){
        $coupons = Coupon::where(['is_available'=>'yes'])
//            ->where(function ($query){
//                $query->where('start_date','<=',date('Y-m-d'))
//                    ->orwhere('start_date',null);
//            })
//            ->where(function ($query){
//                $query->where('end_date','>=',date('Y-m-d'))
//                    ->orwhere('end_date',null);
//            })
            ->whereHas('coupon_users',function($query3){
                $query3->where('user_id',user_api()->user()->id)->where('is_paid','no');
            });

        return $this->apiResponse($coupons);

    }
}
