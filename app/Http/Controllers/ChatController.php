<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use App\User;
use App\ChatMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ChatController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }

    public function FindUser()
    {
        if(request()->ajax()){
            $input = Input::get('data');

            if(Chat::validatedStartChat($input) !== true){
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

        //Create the Actual Chat connection
        DB::insert('insert into chat_conversation_message (user_id_belongs_to, user_id_send_towards, created_at) values (?, ?, ?)',
                            [$chat->user_id_belongs_to, $chat->user_id_send_towards, Carbon::now()]);

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

    public function StoreChatMessage(Request $request, $id)
    {

        $validated = $request->validate([
            'chat_text_message_form' => 'required|min:5|max:350|string'
        ]);

        if(ChatMessage::validatedConversationId($id) !== true){
            abort(403, 'Unauthorized action.');
        }

        $chatMessage = new ChatMessage();
        $chatMessage->user_id_foreign = auth()->user()->id;
        $chatMessage->conversation_id_foreign = $id;
        $chatMessage->message = $validated['chat_text_message_form'];
        $chatMessage->save();

        return back()->withMessage('Message posted!');

    }
}
