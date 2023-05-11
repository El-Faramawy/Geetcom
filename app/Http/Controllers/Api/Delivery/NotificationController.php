<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Notification;

class NotificationController extends Controller
{
    use PaginateTrait;
    public function notifications(){
        Notification::where(['delivery_id'=>delivery_api()->user()->id,'type'=>'notification'])->update(['is_read'=>true]);
        $notifications = Notification::where(['delivery_id'=>delivery_api()->user()->id,'type'=>'notification']);

        return $this->apiResponse($notifications);
    }//end fun
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotificationsCount()
    {
        $notificationsCount = Notification::where(['delivery_id'=>delivery_api()->user()->id,'type'=>'notification'])->where('is_read',false)->count();
        return $this->apiResponse($notificationsCount,null,'simple');
    }//end fun



}
