<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request){
        $users = User::withCount('chat_messages','unread_messages')->orderBy('chat_messages_count', 'desc')->get();
        if ($request->id && $request->id != null){
            $one_user = User::where('id',$request->id)->with('chat_messages')->first();
            $one_user->chat_messages()->update(['is_read'=>1]);
        }else{
            $one_user = null;
        }
        return view('Admin.Chat.index',compact('users','one_user'));
    }
    //=========================================================================
    public function send_chat(Request $request){
        $data = $request->all();
        $data['message_from'] = 'admin';
        Chat::create($data);

//        event(new \App\Events\chat($request->reservation_id,$data['message'],$data['sender_type']));
//        if (doctor()->check())
//            event(new \App\Events\chatUser($request->reservation_id,$data['user_id'],$reservation['doctor']['name'],$data['message']));
//        else
//            event(new \App\Events\chatDoctor($request->reservation_id,$data['doctor_id'],$reservation['user']['name'],$data['message']));

        return response()->json([
//            'message'=>'sent successfully',
            'success'=>'true'
        ]);
    }
    //=========================================================================
}
