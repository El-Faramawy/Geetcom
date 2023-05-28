<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\SmsTrait;
use App\Models\Delivery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{
    use SmsTrait,PaginateTrait;
    public function get_code(Request $request){
        $validator = Validator::make($request->all(), [ // <---
            'phone' => 'required|exists:deliveries,phone',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }
        $user = Delivery::where('phone',$request->phone)->first();
        if ($user){
            if (strlen($request->phone) == 11){
                $code = '111111';
                $user->update([
                    'code'=>$code
                ]);
                return $this->apiResponse(null,'code sent successfully','simple');
            }
            $code = rand('000000', '999999');
            $user->update([
                'code' => $code
            ]);

            $this->sendOtp(strval($request->phone),' رمز تاكيد الهاتف لتطبيق جيتكوم هو '.$code);
            return $this->apiResponse(null,'code sent successfully','simple');

        }else{
            return $this->apiResponse(null,'رقم الهاتف غير موجود','simple',409);
        }

    }

    //*********************************************************************
    public function ConfirmCode(Request $request ){
        $validator = Validator::make($request->all(), [ // <---
            'phone' => 'required|exists:deliveries,phone',
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }
        $user = Delivery::where('phone',$request->phone)->where('code',$request->code)->first();
        if ($user && $user->code!=null){
            $user->code = null;
            $user->save();
            $user->token = '';
            if ($request->register == 'yes'){
                $token = delivery_api()->login($user); // generate token
//                $user = User::where('id',$user->id)->first();
                $user->token = $token;
            }
            return $this->apiResponse($user,'yes','simple');
        }else{
            return $this->apiResponse(null,'رقم الهاتف او الكود خطا','simple',409);
        }
    }//end fun

    //*********************************************************************

    public function UpdatePassword(Request $request ){
        $validator = Validator::make($request->all(), [ // <---
            'phone' => 'required|exists:deliveries,phone',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }
        $user = Delivery::where('phone',$request->phone)->first();
        $user->update([
                'password'=>Hash::make($request->password),
            ]);
        $token = delivery_api()->login($user); // generate token
        $user->token = $token;
        return $this->apiResponse($user,'done','simple');
    }//end fun
}
