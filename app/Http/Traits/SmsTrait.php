<?php

namespace App\Http\Traits;

trait  SmsTrait
{
    function sendOtp($phone,$message)
    {
        $phone =  '966'.$phone;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://rest.gateway.sa/api/SendSMS',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "api_id": "API73223585263",
                "api_password": "Aa123123123",
                "sms_type": "T",
                "encoding": "T",
                "sender_id": "Gateway.sa",
                "phonenumber": "'.strval($phone).'",
                "templateid": null,
                "textmessage": "'.$message.'",
                "V1": null,
                "V2": null
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
