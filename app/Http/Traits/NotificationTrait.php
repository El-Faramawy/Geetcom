<?php


namespace App\Http\Traits;
use App\Models\Notification;
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

    public function sendFCMNotification($array_to, $title, $message, $type = null)
    {
            $tokens = PhoneToken::whereIn("user_id", $array_to)->pluck('phone_token')->toArray();

        $SERVER_API_KEY = env('FIREBASE_KEY');
        $data = [
            "registration_ids" => $tokens,
            "notification" => [
                "title" => $title,
                "body" => $message,
                "sound" => "default" // required for sound on ios
            ],
            "data" => [
                "title" => $title,
                "body" => $message,
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
    }

    //****************************************************************************************

    public function sendNotification($array_to, $title, $message, $type = null)
    {
        $data = [];
        $data['title'] = $title;
        $data['message'] = $message;

            foreach ($array_to as $user){
                $data['user_id'] = $user;
                Notification::create($data);
                $data['user_id'] = null;
            }


    }

}
