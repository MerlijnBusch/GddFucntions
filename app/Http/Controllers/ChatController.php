<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
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

            //Check if the chat already exist
            if(Chat::validatedStartChat($input) !== true){
                return response()->json(['status' => 'fail', 'message' => 'Chat already exist']);
            }

            //create a new chat and put it on pending to let the other user accept
            $chat = new Chat;
            $chat->user_id_belongs_to = auth()->user()->id;
            $chat->user_id_send_towards = $input;
            $chat->user_id_belongs_to_accepted_boolean = true;
            $chat->user_id_send_towards_accepted_boolean = false;
            $chat->save();

            //return success status json
            return response()->json(['status' => 'success', 'message' => 'request has been send']);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'an error occurred']);
        }

    }

    public function AcceptChatRequest(Chat $chat)
    {

        //See if there's an pending chat request
        if($chat->user_id_send_towards != auth()->user()->id){
            abort(403, 'Unauthorized action.');
        }

        //if the chat request was pending and exist we accepted it and save
        $chat->user_id_send_towards_accepted_boolean = true;
        $chat->save();

        DB::insert('insert into chat_conversation_message (user_id_belongs_to, user_id_send_towards, created_at) values (?, ?, ?)',
                            [$chat->user_id_belongs_to, $chat->user_id_send_towards, Carbon::now()]);

        return back()->withMessage('Chat is Accepted');
    }

    //destroy chat request
    public function DestroyChatRequest(Chat $chat)
    {
        if($chat->user_id_send_towards != auth()->user()->id){
            abort(403, 'Unauthorized action.');
        }

        $chat->delete();

        return back()->withMessage('Chat is Deleted');
    }

    //store chats
    public function StoreChatMessage(Request $request, $id)
    {

        //validate the chat message
        $validated = $request->validate([
            'chat_text_message_form' => 'required|min:1|max:350|string'
        ]);

        //is the text doesnt belong toward the right chat
        if(ChatMessage::validatedConversationId($id) !== true){
            abort(403, 'Unauthorized action.');
        }

        //create the chat message with foreign key of accepted chat and then save the text in the database
        $chatMessage = new ChatMessage();
        $chatMessage->user_id_foreign = auth()->user()->id;
        $chatMessage->conversation_id_foreign = $id;
        $chatMessage->message = $validated['chat_text_message_form'];
        $chatMessage->save();

        return back()->withMessage('Message posted!');

    }
}
