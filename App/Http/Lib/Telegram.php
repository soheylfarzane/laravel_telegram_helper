<?php

namespace App\Http\Lib;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class Telegram
{
    protected $baseUrl;
    protected $token;
    protected $sendPath;
    protected $forwardPath;
    protected $copyMessagePath;
    protected $sendPhotoPath;
    protected $sendLocationPath;

    public function __construct()
    {
        $this->baseUrl = 'https://api.telegram.org/bot'.$this->token = env('BOT_TOKEN');
        $this->sendPath = '/sendMessage';
        $this->forwardPath = '/forwardMessage';
        $this->copyMessagePath = '/copyMessage';
        $this->sendLocationPath = '/sendLocation';
        $this->sendPhotoPath = '/sendPhoto';
    }
    private function curl($parameter,$val)
    {

        $url = $this->baseUrl.$this->token.$parameter;
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
    public  function send($chatId,$message,$keyboard = [],$reply = '',$parsMode = 'HTML')
    {
        $url = $this->baseUrl.$this->sendPath;
        $client = new Client([ 'verify' => false ]);
        $response = $client->get($url, [
            'headers' => [

            ],
            'auth' => [
            ],
            'json' =>[
                'parse_mode' => $parsMode,
                'chat_id' => $chatId,
                'text' => $message,
                'reply_to_message_id' => $reply,
                'reply_markup' => json_encode(array('keyboard' => $keyboard))
            ]]);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;
}
    public  function sendToChannel($chatId,$message,$reply = '',$parsMode = 'HTML')
    {
        $url = $this->baseUrl.$this->sendPath;
        $client = new Client([ 'verify' => false ]);
        $response = $client->get($url, [
            'headers' => [

            ],
            'auth' => [
            ],
            'json' =>[
                'parse_mode' => $parsMode,
                'chat_id' => $chatId,
                'text' => $message,
                'reply_to_message_id' => $reply,
                'disable_web_page_preview' => true,
            ]]);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;
    }
    public function sendPhoto($chatId,$photo,$reply = '')
    {

        $val = [
            'chat_id' => $chatId,
            'photo' => $photo,
            'reply_to_message_id' => $reply,

            ];
        $response =   $this->curl($this->sendPhotoPath,$val);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;

    }
    public function forwardMessage($chatId,$fromChatId,$messageId)
    {
        $Url = $this->baseUrl.$this->forwardPath;
        $client = new Client([ 'verify' => false ]);
        $response = $client->get($Url, [
            'headers' => [

            ],
            'auth' => [
            ],
            'json' =>[
                'parse_mode' => 'HTML',
                'chat_id' => $chatId,
                'from_chat_id' => $fromChatId,
                'message_id' => $messageId,
            ]]);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;


    }
    public function copyMessage($chatId,$fromChatId,$messageId,$caption)
    {
        $Url = $this->baseUrl.$this->copyMessagePath;
        $client = new Client([ 'verify' => false ]);
        $response = $client->get($Url, [
            'headers' => [

            ],
            'auth' => [
            ],
            'json' =>[
                'parse_mode' => 'HTML',
                'chat_id' => $chatId,
                'from_chat_id' => $fromChatId,
                'message_id' => $messageId,
                'caption' => $caption,

            ]]);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;


    }
    public function sendLocation($chatId,$latitude,$longitude,$reply = '')
    {

        $val = [
            'chat_id' => $chatId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'reply_to_message_id' => $reply,

        ];
        $response =   $this->curl($this->sendLocationPath,$val);
        $data = $response->getBody();
        $obj = json_decode($data);
        return $obj;

    }
}
