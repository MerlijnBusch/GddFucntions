<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChatMessage extends Model
{
    public static function validatedConversationId($id)
    {
        $conversations = DB::table('chat_conversation_message')
            ->where(function ($query) {
                $query->where('user_id_belongs_to', '=', auth()->user()->id)
                    ->orWhere('user_id_send_towards', '=', auth()->user()->id);
            })->get();

        foreach ($conversations as $q) {
            if($id == $q->conversation_id){
                return true;
            }
        }
        return false;
    }
}
