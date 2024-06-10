<?php

namespace App\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Http;

class Firebase
{
    protected $client;

    protected $token;
    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    private $http;

    /**
     * Firebase constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->token = env('FIREBASE_SERVER_KEY');
        $this->http = Http::baseUrl('https://fcm.googleapis.com')->withHeaders([
            "Authorization" => "key={$this->token}",
            'Content-Type' => 'application/json',
        ]);
    }


    /**
     * @param $notification
     * @param $tokens
     * @return \Exception|ClientException|\Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send_notification($notification, $tokens)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = [
            "registration_ids" => $tokens,
            'notification' => $notification,
            'data' => $notification,
            'priority' => 'high'
        ];

        $headers = [
            "Authorization" => "key={$this->token}",
            'Content-Type' => 'application/json',
        ];

        try {
            $this->http->post('', $fields)->throw()->body();
        } catch (ClientException $exception) {
            return $exception;
        }

    }

    public function send_all($notification)
    {
        try {
            return $this->http->post('fcm/send', [
                'notification' => $notification,
                'data' => $notification,
                'priority' => 'high',
                'content_available' => true,
                "to" => "/topics/all"
            ])->body();
        } catch (ClientException $exception) {
            return $exception;
        }

    }

}
