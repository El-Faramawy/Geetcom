<?php

namespace App\Http\Traits;

use App\Models\CouponUser;

Trait  CanceledOrderTrait
{
//use NotificationTrait;
    //===================  cancelOrder ===========================
    private function cancelOrder($order = '')
    {
        if ($order->status == 'canceled_from_market' ){
            $this->sendAllNotifications([$order->user_id], 'تم الغاء الطلب ', 'تم الغاء الطلب من المتجر','user',$order);
            if ($order->delivery_id)
                $this->sendAllNotifications([$order->delivery_id], 'تم الغاء الطلب ', 'تم الغاء الطلب من الادمن','delivery',$order);

        }elseif ($order->status == 'canceled_from_delivery'){
            $this->sendAllNotifications([$order->user_id], 'تم الغاء الطلب ', 'تم الغاء الطلب من المندوب','user',$order);
        }
        elseif ($order->status == 'canceled_from_admin'){
            $this->sendAllNotifications([$order->user_id], 'تم الغاء الطلب ', 'تم الغاء الطلب من الادمن','user',$order);
            if ($order->market_id)
                $this->sendAllNotifications([$order->market_id], 'تم الغاء الطلب ', 'تم الغاء الطلب من الادمن','market',$order);
            if ($order->delivery_id)
                $this->sendAllNotifications([$order->delivery_id], 'تم الغاء الطلب ', 'تم الغاء الطلب من الادمن','delivery',$order);
        }

        $this->returnBackData($order);

    }
    //===================  returnBackData ===========================
    private function returnBackData($order = '')
    {
        if (in_array($order->status ,['canceled_from_market', 'canceled_from_delivery','canceled_from_admin'])){
         // return coupon back
            if ($order->coupon_id){
                CouponUser::where(['user_id' => $order->user_id,'coupon_id' => $order->coupon_id])
                    ->update(['is_paid' =>'no']);
                $order->coupon_id = null;
                $order->save();
            }
        // return wallet back
            if ($order->wallet_pay != 0){
                $order->user->update([ 'wallet' => $order->user->wallet + $order->wallet_pay ]);
            }

        }

    }

}
