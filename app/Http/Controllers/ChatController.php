<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use App\User;
use App\ChatMessage;
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

    public function AcceptChatRequest(Chat $chat)
    {

        if($chat->user_id_send_towards != auth()->user()->id){
            abort(403, 'Unauthorized action.');
        }

        //Accepted the chat
        $chat->user_id_send_towards_accepted_boolean = true;
        $chat->save();

        //Create the Actual Chat
        $chatMessage = new ChatMessage;

        $chatMessage->user_id_belongs_to = $chat->user_id_belongs_to;
        $chatMessage->user_id_send_towards = $chat->user_id_send_towards;
        $chatMessage->save();

        return back()->withMessage('Chat is Accepted');
    }

    public function DestroyChatRequest(Chat $chat)
    {
        if($chat->user_id_send_towards != auth()->user()->id){
            abort(403, 'Unauthorized action.');
        }

        $chat->delete();

        return back()->withMessage('Chat is Deleted');
    }
}
