<?php


namespace App\Http\Traits;
use App\Models\Notification;
use App\Models\Order;
use App\Models\PhoneToken;
use App\Models\Setting;
use App\Models\User;

trait NotificationTrait
{
    /*
       |--------------------------------------------------------------------------
       | send Firebase Notification
       |--------------------------------------------------------------------------
       |
       |this function take a 3 params
       |1- array of users Id , you want to sent
       |2-single id to get the name of sender
       |3-mess array to send
       |
       | Support: "ios ", "android"
       |
       */

    public function sendAllNotifications($array_to, $title, $message, $type = null,$order=null){
        $data = [];
        if ($order!=null){
            $data['order_id'] = $order['id'];
            $data['status'] = $order['status'];
            $data['order'] = Order::where('id', $order['id'])->first();
            $data = json_encode($data);
        }

        $this->sendNotification($array_to, $title, $message, $type);
        $this->sendFCMNotification($array_to, $title, $message, $type,$data);
    }

    //****************************************************************************************
    public function sendFCMNotification($array_to, $title, $message, $type = null ,$data = null)
    {
        if ($type == 'delivery') {
            $tokens = PhoneToken::whereIn("delivery_id", $array_to)->pluck('phone_token')->toArray();
        }
        elseif ($type == 'market') {
            $tokens = PhoneToken::where("market_id",$array_to )->pluck('phone_token')->toArray();
        }else{
            $tokens = PhoneToken::whereIn("user_id", $array_to)->pluck('phone_token')->toArray();
        }

        $SERVER_API_KEY = env('FIREBASE_KEY');
        $data = [
            "registration_ids" => $tokens,
            "notification" => [
                "title" => $title,
                "body" => $message,
                "data_" => $data,
                "sound" => "default" // required for sound on ios
            ],
            "data" => [
                "title" => $title,
                "body" => $message,
                "data_" => $data,
            ],
        ];
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
//        return $response;
    }

    //****************************************************************************************

    public function sendNotification($array_to, $title, $message, $type = null)
    {
        $data = [];
        $data['title'] = $title;
        $data['message'] = $message;

        if ($type == 'delivery') {
            foreach ($array_to as $delivery){
                $data['delivery_id'] = $delivery;
                Notification::create($data);
                $data['delivery_id'] = null;
            }
        } elseif ($type == 'market') {
            foreach ($array_to as $market){
                $data['market_id'] = $market;
                Notification::create($data);
                $data['market_id'] = null;
            }
        }else {
            foreach ($array_to as $user){
                $data['user_id'] = $user;
                Notification::create($data);
                $data['user_id'] = null;
            }
        }


    }

}
