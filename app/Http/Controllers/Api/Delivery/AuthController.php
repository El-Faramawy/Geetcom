<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Delivery;
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
    use PhotoTrait,PaginateTrait;

    public function login(Request $request){
        try {
            // validation
            $validator = Validator::make($request->all(),[
                'phone'=>'required',
                'password'=>'required',
            ]);
            if ($validator->fails()){
                return $this->apiResponse(null,$validator->errors(),'simple','422');
            }

            $data = $request->only('phone','password','fcm_token');

            $credentials = ['phone'=>$data['phone'] , 'password'=>$data['password']];
            $token = delivery_api()->attempt($credentials);
            if ($token){
                $user = Delivery::where('id',delivery_api()->user()->id)->first();
                $user->token = $token;
                PhoneToken::updateOrCreate([
                    'delivery_id'=>$user->id ,
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

    //=======================================================================================================

    public function register(Request $request){
        try {
            // validation
            $validator = Validator::make($request->all(),[
                'phone'=>'required|unique:deliveries,phone',
                'f_name'=>'required',
                'l_name'=>'required',
                'password'=>'required'
            ]);
            if ($validator->fails()){
                return $this->apiResponse(null,$validator->errors(),'simple','422');
            }
            $data = $request->only('f_name','l_name','phone','password');
            $data['password'] = Hash::make($request->password);
            $user = Delivery::create($data);

            $token = delivery_api()->login($user); // generate token
            $user = Delivery::where('id',$user->id)->first();
            $user->token = $token;

            PhoneToken::updateOrCreate([
                'delivery_id'=>$user->id ,
                'phone_token'=>$request->fcm_token,
                'type'=>'android',
            ]);

            return $this->apiResponse($user,'','simple');

        }catch (\Exception $ex){
            return $this->apiResponse($ex->getCode(),$ex->getMessage(),'simple','422');
        }

    }

    //===========================================
    public function profile(Request $request){
        $user = Delivery::where('id',delivery_api()->user()->id)->first();
        $user->token = getToken();
        return $this->apiResponse($user,'','simple');
    }
    //===========================================
    public function update_profile(Request $request){
        // validation
        $validator = Validator::make($request->all(),[
            'phone'=>'required|unique:deliveries,phone,'.delivery_api()->user()->id,
            'f_name'=>'required',
            'l_name'=>'required'
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }
        $data = $request->only('f_name','phone','l_name','password','image','latitude','longitude');
        if ($request->password && $request->password != null){
            $data['password'] = Hash::make($request->password);
        }
        $user = Delivery::where('id',delivery_api()->user()->id)->first();
        if ( $request->image && $request->image != null )
            $data['image'] = $this->saveImage($request->image,'uploads/delivery',$user->getAttributes()['image']);

        $user->update($data);
        $user->token =getToken();

        return $this->apiResponse($user,'','simple');

    }

    //=======================================================================================================
    public function logout(Request $request){
        $validator = Validator::make($request->all(), [ // <---
            'token' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }

        if (!delivery_api()->check())
        {
            return $this->apiResponse(null,'logout once or token is not valid','simple');
        }

        PhoneToken::where(['delivery_id' => delivery_api()->user()->id, 'phone_token' => $request->token])->delete();

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
