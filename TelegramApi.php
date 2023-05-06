<?php

namespace App\Http\Lib;

use GuzzleHttp\Client;

class TelegramApi
{
    private function curl($parameter,$val)
    {
        $token = env('BOT_TOKEN');

//        ADD THIS TO ENV AND REPLACE YOUR BOT TOKEN
//        BOT_TOKEN='5632857370:AAGcuZr7Cpn-gANd1u5uMs5pnMA3btpU6aM'
        $url = 'https://api.telegram.org/bot'.$token.$parameter;
        $client = new Client([ 'verify' => false ]);
        $response = $client->post($url, [
            'headers' => [

            ],
            'auth' => [
            ],
            'json' =>
                $val
            ]);
        return $response;
    }
    public function get()
    {
        $parameter = '/getMe';
        $val = [];
        $response =   $this->curl($parameter,$val);
        $data = $response->getBody();
        $obj = json_decode($data);
          return $obj;

}
    public function send($chatId,$message,$reply = '',$parsMode = 'HTML')
    {
        $parameter = '/sendMessage';
        $val = [
            'parse_mode' => $parsMode,
            'chat_id' => $chatId,
            'text' => $message,
            'reply_to_message_id' => $reply,
            ];
        $response =   $this->curl($parameter,$val);
        $data = $response->getBody();
        $obj = json_decode($data);
          return $obj;

}
    public function sendPhoto($chatId,$photo,$reply = '')
    {
        $parameter = '/sendPhoto';
        $val = [
            'chat_id' => $chatId,
            'photo' => $photo,
            'reply_to_message_id' => $reply,
            'reply_markup' => [
                'salam' => 'salam'
            ]

            ];
        $response =   $this->curl($parameter,$val);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;

    }
    public function forwardMessage($chatId,$from,$message_id,$reply = '')
    {
        $parameter = '/forwardMessage';
        $val = [
            'chat_id' => $chatId,
            'from_chat_id' => $from,
            'message_id' => $message_id,
            'reply_to_message_id' => $reply,
        ];
        $response =   $this->curl($parameter,$val);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;

    }
    public function sendLocation($chatId,$latitude,$longitude,$reply = '')
    {

        $parameter = '/sendLocation';
        $val = [
            'chat_id' => $chatId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'reply_to_message_id' => $reply,

        ];
        $response =   $this->curl($parameter,$val);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;

    }
}
