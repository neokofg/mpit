<?php

namespace App\Http\Controllers;

use App\Models\Telegram;
use App\Models\TourbaseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BotController extends Controller
{
    // 6112927855:AAF-Rc36LyNcLeFuyjJw8vdEfDBw_QEnhMo
    protected function botResponse()
    {
        $result = file_get_contents('php://input');
        $update = json_decode($result);

        if (isset($update->message->text)) {
            $user = Telegram::where('user_id', '=', $update->message->from->id)->first();
            if ($update->message->text == '/start') {
                if ($user == '[]') {

                    $userdata = array(
                        'user_id' => $update->message->from->id,
                        'name' => '@' . $update->message->from->username,
                        'status' => 'started',
                    );
                    Telegram::create($userdata);

                    $data = [
                        'chat_id' => $update->message->chat->id,
                        'reply_to_message_id' => $update->message->message_id,
                        'text' => 'Здравствуйте! Я ваш личный помощник по агрегатору Tourclick!!!'
                    ];
                    $response = Http::get("https://api.telegram.org/bot6112927855:AAF-Rc36LyNcLeFuyjJw8vdEfDBw_QEnhMo/sendMessage?" . http_build_query($data));
                    $data = [
                        'chat_id' => $update->message->chat->id,
                        'reply_to_message_id' => $update->message->message_id,
                        'text' => 'Для начала войдите в свой аккаунт'
                    ];
                    $response = Http::get("https://api.telegram.org/bot6112927855:AAF-Rc36LyNcLeFuyjJw8vdEfDBw_QEnhMo/sendMessage?" . http_build_query($data));
                    $data = [
                        'chat_id' => $update->message->chat->id,
                        'reply_to_message_id' => $update->message->message_id,
                        'text' => 'Введите свой логин'
                    ];
                    $response = Http::get("https://api.telegram.org/bot6112927855:AAF-Rc36LyNcLeFuyjJw8vdEfDBw_QEnhMo/sendMessage?" . http_build_query($data));
                }else{
                    $data = [
                        'chat_id' => $update->message->chat->id,
                        'reply_to_message_id' => $update->message->message_id,
                        'text' => 'Для начала войдите в свой аккаунт'
                    ];
                    $response = Http::get("https://api.telegram.org/bot6112927855:AAF-Rc36LyNcLeFuyjJw8vdEfDBw_QEnhMo/sendMessage?" . http_build_query($data));
                    $data = [
                        'chat_id' => $update->message->chat->id,
                        'reply_to_message_id' => $update->message->message_id,
                        'text' => 'Введите свой email'
                    ];
                    $response = Http::get("https://api.telegram.org/bot6112927855:AAF-Rc36LyNcLeFuyjJw8vdEfDBw_QEnhMo/sendMessage?" . http_build_query($data));
                }
            }
        }
    }
}
