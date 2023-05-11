<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\SendEmail;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    use SendEmail;
    use NotificationTrait;
    public function index(Request $request)
    {
        $users = User::where(['block'=> 'no'/*,'is_active'=>'yes'*/])->get();
        return view('Admin.Notification.index',compact('users'));
    }

    public function store(Request $request)
    {
        $valedator = Validator::make($request->all(), [
            'message' => 'required ',
            'title' => 'required',
        ],
            [
                'title.required' => 'عنوان الرسالة مطلوب',
                'message.required' => ' الرسالة مطلوبة',
            ]
        );
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        if ($request->users){
            $this->sendNotification($request->users,$request->title,$request->message);
            $this->sendFCMNotification($request->users,$request->title,$request->message);

            foreach ($request->users as $user){
                $email = User::where('id',$user)->pluck('email')->first();
                if (filter_var($email, FILTER_VALIDATE_EMAIL))
                    $this->send_EmailFun($email,$request->message,$request->title);
            }
        }


        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الارسال بنجاح'
            ]);
    }
    ###############################################


}
