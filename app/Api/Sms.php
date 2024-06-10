<?php

namespace App\Api;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class Sms
{
    const URL = '';
    const ORIGINATOR = '';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    public function send(int $phone, string $message)
    {
//        $user = '';
//        $password = '';
//
//        try {
//            Http::asForm()->post("https://adminka.smobile.uz/smsgate/send-sms.php", [
//                'username' => $user,
//                'password' => $password,
//                'phone_number' => $phone,
//                'message' => $message
//            ]);
//        } catch (\Exception $exception) {
//            return false;
//        }


        $data = [
            'messages' => [
                [
                    'recipient' => $phone,
                    'message-id' => time(),
                    'sms' => [
                        'originator' => '3700',
                        'content' => [
                            'text' => '24seven - '.$message
                        ]
                    ]
                ]
            ]
        ];

        $data_string = json_encode($data);

        $username = 'bbqburger';
        $password = 'l84yyQc4h';

        $ch = curl_init('http://91.204.239.44/broker-api/send ');
        curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );

        $result = curl_exec($ch);

        return true;
    }
}
