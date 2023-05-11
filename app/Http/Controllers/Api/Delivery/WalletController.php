<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Delivery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    use WithRelationTrait, PaginateTrait;
    //======================================================================
    public function convert_points(Request $request){
        $validator = Validator::make($request->all(),[
            'points'=>'required',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }

        if ($request->points < setting()->delivery_points || delivery_api()->user()->points < $request->points )
            return $this->apiResponse(null,'points is not enough','simple',409);

        $point_multiply_number = (int) ($request->points / setting()->delivery_points) ;
        delivery_api()->user()->update([
            'points' => delivery_api()->user()->points - ($point_multiply_number * setting()->delivery_points),
            'wallet' => delivery_api()->user()->wallet + ($point_multiply_number * setting()->delivery_wallet)
        ]);

        $user = Delivery::where('id',delivery_api()->user()->id)->first();
        return $this->apiResponse($user,'','simple');
    }
    //======================================================================

}
