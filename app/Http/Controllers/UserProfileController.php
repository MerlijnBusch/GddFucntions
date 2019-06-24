<?php

namespace App\Http\Controllers;

use App\ChatMessage;
use Illuminate\Http\Request;
use App\User;
use App\Story;
use App\Chat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserProfileController extends Controller
{
    //return user profile
    public function index(User $user)
    {
        //check if the user is on there own profile or not
        if($user->id != auth()->user()->id){
            abort(403, 'Unauthorized action.');
        }

        //get all pending chat request
        $chatRequests = Chat::CheckChatRequest();

        //return all conversations who are active
        $conversations = DB::table('chat_conversation_message')
            ->where(function ($query) {
                $query->where('user_id_belongs_to', '=', auth()->user()->id)
                    ->orWhere('user_id_send_towards', '=', auth()->user()->id);
            })->get();

        //get all the message to the active chats
        $allMessages = [];
        foreach ($conversations as $q) {
            $allMessages[] = ChatMessage::all()->where('conversation_id_foreign', '=', $q->conversation_id);
        }

        return view('profile.index',
            compact('user', 'chatRequests', 'conversations','allMessages')
        );
    }

    //find an user to start a chat request with
    public function search_user()
    {
        if(request()->ajax()){
            $input = Input::get('data');
            $user = User::where('name', 'LIKE', '%' . $input . '%')
                ->where('id', '!=', auth()->user()->id)
                ->get();
            return response()->json(['status' => 'success', 'message' => $user]);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'an error occurred']);
        }
    }
}
