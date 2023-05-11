<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Notification;

class NotificationController extends Controller
{
    use PaginateTrait;
    public function notifications(){
        Notification::where('user_id',user_api()->user()->id)->update(['is_read'=>true]);
        $notifications = Notification::where('user_id',user_api()->user()->id);
//        $notifications = $this->paginate_case($notifications);
//        return response()->json($this->paginate_case($notifications));
        return $this->apiResponse($notifications);
    }//end fun
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotificationsCount()
    {
        $notificationsCount = Notification::where('user_id',user_api()->user()->id)->where('is_read',false)->count();
        return $this->apiResponse($notificationsCount,null,'simple');
    }//end fun



}
