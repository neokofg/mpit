<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotController extends Controller
{
    // 6112927855:AAF-Rc36LyNcLeFuyjJw8vdEfDBw_QEnhMo
    protected function botResponse()
    {
        $result = file_get_contents('php://input');
        $update = json_decode($result);

        if ($update->message->text == '/start') {
            $data = [
                'chat_id' => $update->message->chat->id,
                'reply_to_message_id' => $update->message->message_id,
                'text' => 'Здравствуйте! Я ваш личный помощник по агрегатору Tourclick!!!'.PHP_EOL.'Для начала войдите в свой аккаунт'
            ];
            $response = Http::get("https://api.telegram.org/bot6112927855:AAF-Rc36LyNcLeFuyjJw8vdEfDBw_QEnhMo/sendMessage?" . http_build_query($data));
        }
    }
}
