<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{
    use SendEmail;
    public function get_code(Request $request){
        $validator = Validator::make($request->all(), [ // <---
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return apiResponse(null,$validator->errors(),'422');
        }
        $user = User::where('email',$request->email)->first();
        $code = rand('000000','999999');
        $user->update([
            'code'=>$code
        ]);
        if ($user){
            if (filter_var($user->email, FILTER_VALIDATE_EMAIL)){
                $this->send_EmailFun($request->email,$code,'رمز تأكيد كلمة المرور');
                return apiResponse(null,'code sent successfully');
            }else{
                return apiResponse(null,'البريد الالكترونى غير فعال',410);
            }
        }else{
            return apiResponse(null,'mail not found',409);
        }
    }

    //*********************************************************************
    public function ConfirmCode(Request $request ){
        $user = User::where('email',$request->email)->where('code',$request->code)->first();
        if ($user && $user->code!=null){
            $user->code = null;
            $user->save();
            return apiResponse($user,'yes');
        }else{
            return apiResponse(null,'mail or code not correct');
        }
    }//end fun

    //*********************************************************************

    public function UpdatePassword(Request $request ){
        $validator = Validator::make($request->all(), [ // <---
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return apiResponse(null,$validator->errors(),'422');
        }
        $user = User::where('email',$request->email)->first();
        $user->update([
                'password'=>Hash::make($request->password),
            ]);
        return apiResponse($user,'done');
    }//end fun
}
