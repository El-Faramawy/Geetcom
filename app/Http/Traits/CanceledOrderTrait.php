<?php

namespace App\Http\Traits;

use App\Models\CouponUser;

Trait  CanceledOrderTrait
{

    //===================  cancelOrder ===========================
    private function cancelOrder($order = '')
    {
//        if ($order->status == 'canceled_from_market' ){
//            $this->sendNotification(null, 'nuovo ordine ', 'nuovo ordine per te','admin');
//            $this->sendFCMNotification(null, 'nuovo ordine ', 'nuovo ordine per te','admin');
//        }elseif ($order->status == 'canceled_from_market'){
//            $this->sendNotification(null, 'nuovo ordine ', 'nuovo ordine per te','admin');
//            $this->sendFCMNotification(null, 'nuovo ordine ', 'nuovo ordine per te','admin');

//        }elseif ($order->status == 'canceled_from_market'){
//            $this->sendNotification(null, 'nuovo ordine ', 'nuovo ordine per te','admin');
//            $this->sendFCMNotification(null, 'nuovo ordine ', 'nuovo ordine per te','admin');
//        }
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
