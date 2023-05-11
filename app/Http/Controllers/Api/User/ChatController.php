<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\WithRelationTrait;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    use WithRelationTrait, PaginateTrait;
    /*================================================*/
    public function send_message(Request $request){
        $validator = Validator::make($request->all(),[
            'message'      =>'required',
        ]);
        if ($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),'simple','422');
        }

        $data = $request->only('message');
        $data['user_id'] = user_api()->user()->id;
        $data['message_from'] = 'user';
        $chat = Chat::create($data);

        $chat = Chat::with($this->chatRelations())->where('id', $chat->id)->first();

        return $this->apiResponse($chat,'','simple');
    }
    /*================================================*/
    public function get_chat(Request $request){
        $chat = Chat::where('user_id',user_api()->user()->id)->with($this->chatRelations());

        return $this->apiResponse($chat);
    }
    /*================================================*/
}
