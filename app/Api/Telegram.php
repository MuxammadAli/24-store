<?php


namespace App\Api;


use Illuminate\Support\Facades\Http;

class Telegram
{
    /**
     * @param $text
     * @return void
     */
    public static function sendMessage($text): void
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chat_id = env('TELEGRAM_CHAT_ID');

        $params = [
            'text' => $text,
            'chat_id' => $chat_id,
            'parse_mode' => 'markdown'
        ];

        file_get_contents("https://api.telegram.org/bot{$token}/sendMessage?".http_build_query($params));
    }
}
