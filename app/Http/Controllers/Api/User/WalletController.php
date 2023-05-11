<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    use WithRelationTrait, PaginateTrait;
    //======================================================================
    public function wallet_coupon(Request $request){
        $validator = Validator::make($request->all(),[
            'code'=>'required',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }

        $coupon = Coupon::where(['is_available'=>'yes','coupon_on'=>'points','code'=>$request->code])->first();

        if ($coupon){
            $coupon_user = CouponUser::where(['coupon_id'=>$coupon->id,'user_id'=>user_api()->user()->id])->first();
            if($coupon_user){
                if ($coupon_user->is_paid == 'no'){
                    user_api()->user()->update(['points'=>user_api()->user()->points + $coupon->value]);
                    $coupon_user->update(['is_paid'=>'yes']);
                    return $this->apiResponse($coupon,'','simple');
                }else{
                    return $this->apiResponse(null,'coupon is used before from the user','simple',411);
                }
            }else{
                return $this->apiResponse(null,'coupon is not allowed for this user','simple',410);
            }
        }else{
            return $this->apiResponse(null,'coupon is wrong','simple',409);
        }

    }
    //======================================================================
    public function update_points(Request $request){
        $validator = Validator::make($request->all(),[
            'points'=>'required',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }

        if ($request->points < setting()->points || user_api()->user()->points < $request->points )
            return $this->apiResponse(null,'points is not enough','simple',409);

        $point_multiply_number = (int) ($request->points / setting()->points) ;
        user_api()->user()->update([
            'points' => user_api()->user()->points - ($point_multiply_number * setting()->points),
            'wallet' => user_api()->user()->wallet + ($point_multiply_number * setting()->wallet_per_points)
        ]);

        $user = User::where('id',user_api()->user()->id)->first();
        return $this->apiResponse($user,'','simple');

    }

}
