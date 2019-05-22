<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;

class ChatController extends Controller
{
    public function FindUser()
    {
        if(request()->ajax()){
            $input = Input::get('data');

            $validated = Chat::validatedStartChat($input);
            if($validated !== true){
                return response()->json(['status' => 'fail', 'message' => 'Chat already exist']);
            }

            $chat = new Chat;
            $chat->user_id_belongs_to = auth()->user()->id;
            $chat->user_id_send_towards = $input;
            $chat->user_id_belongs_to_accepted_boolean = true; //Send the request to start chatting
            $chat->user_id_send_towards_accepted_boolean = false; // Has to still accept
            $chat->save();

            return response()->json(['status' => 'success', 'message' => 'request has been send']);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'an error occurred']);
        }

    }

    public function AcceptChatRequest(Request $request, Chat $chat)
    {
        dd($chat);
    }

    public function DestroyChatRequest(Request $request, Chat $chat)
    {

    }
}
