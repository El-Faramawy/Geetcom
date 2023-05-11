<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
        if (admin()->check()){
            return redirect('admin/home');
        }
        return view('Admin/auth/login');
    }

    //######################## login ###########################

    public function login(Request $request){
        $valedator =Validator::make($request->all(),[
            'email'=>  'required | exists:admins,email',
            'password'=>  'required',
        ],
            [
                'email.exists'=> 'هذا البريد الالكترونى غير موجود',
                'email.required'=> ' البريد الالكترونى مطلوب',
                'password.required'=> ' كلمة المرور مطلوبة',
            ]
        );
        if ($valedator->fails())
            return response()->json(['messages'=>$valedator->errors()->getMessages(),'success'=>'false']);

        $rememberme = request('rememberme') == 1?true:false;
        if (admin()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
            return response()->json(['messages'=>['تم تسجيل الدخول بنجاح'],'success'=>'true']);
        } else {
            return response()->json(['messages'=>['يوجد خطأ فى كلمة المرور'],'success'=>'false']);
        }
    }//end fun
    public function logout(){
        admin()->logout();
        my_toaster('تم تسجيل الخروج بنجاح','warning');
        return redirect('admin/login');
    }
}
