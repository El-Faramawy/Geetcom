<?php

namespace App\Http\Controllers\Api\Market;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use \Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PhoneToken;
use App\Http\Traits\PhotoTrait;

class AuthController extends Controller
{
    use PhotoTrait,PaginateTrait,WithRelationTrait;

    public function login(Request $request){
        try {
            // validation
            $validator = Validator::make($request->all(),[
                'id'=>'required',
                'password'=>'required',
            ]);
            if ($validator->fails()){
                return $this->apiResponse(null,$validator->errors(),'simple','422');
            }

            $data = $request->only('id','password','fcm_token');

            $credentials = ['id'=>$data['id'] , 'password'=>$data['password']];
            $credentials2 = ['user_name'=>$data['id'] , 'password'=>$data['password']];
            $token = market_api()->attempt($credentials);
            $token2 = market_api()->attempt($credentials2);

            if ($token || $token2){
                $user = Market::where('id',market_api()->user()->id)->first();
//                return $token;
                $user->token = $token?:$token2;
                PhoneToken::updateOrCreate([
                    'market_id'=>$user->id ,
                    'phone_token'=>$data['fcm_token'],
                    'type'=>'android',
                ]);
                return $this->apiResponse($user,'','simple');
            }else{
                return $this->apiResponse(null,'خطا فى البيانات  ','simple','409');
            }

        }catch (\Exception $ex){
            return $this->apiResponse($ex->getCode(),$ex->getMessage(),'simple','422');
        }

    }

    //===========================================
    public function profile(Request $request){
        $user = Market::where('id',market_api()->user()->id)->first();
        $user->token = getToken();
        return $this->apiResponse($user,'','simple');
    }
    //===========================================
//    public function update_profile(Request $request){
//        // validation
//        $validator = Validator::make($request->all(),[
//            'phone'=>'required|unique:markets,phone,'.market_api()->user()->id,
//            'f_name'=>'required',
//            'l_name'=>'required'
//        ]);
//        if ($validator->fails()){
//            return $this->apiResponse(null,$validator->errors(),'simple','422');
//        }
//        $data = $request->only('f_name','phone','l_name','password','image');
//        if ($request->password && $request->password != null){
//            $data['password'] = Hash::make($request->password);
//        }
//        $user = Market::where('id',market_api()->user()->id)->first();
//        if ( $request->image && $request->image != null )
//            $data['image'] = $this->saveImage($request->image,'uploads/market',$user->getAttributes()['image']);
//
//        $user->update($data);
//        $user->token =getToken();
//
//        return $this->apiResponse($user,'','simple');
//
//    }

    //=======================================================================================================
    public function logout(Request $request){
        $validator = Validator::make($request->all(), [ // <---
            'token' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }

        if (!market_api()->check())
        {
            return $this->apiResponse(null,'logout once or token is not valid','simple');
        }

        PhoneToken::where(['market_id' => market_api()->user()->id, 'phone_token' => $request->token])->delete();

        $token = getToken();
        if ($token != null){
            try {
                JWTAuth::setToken($token)->invalidate(); // logout user
                return $this->apiResponse(null,'logout done','simple');
            }catch(TokenInvalidException $e){
                return $this->apiResponse(null,'done','simple');
            }
        }
        else{
            return $this->apiResponse(null,'done','simple');
        }
    }
    //=======================================================================================================



}
