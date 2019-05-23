<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public static function validatedStartChat($id)
    {
        if(empty($id)){
            return false;
        }

        $chatAlreadyPending = Chat::where('user_id_belongs_to','=', $id)
            ->where('user_id_send_towards', '=', auth()->user()->id)
            ->where('user_id_belongs_to_accepted_boolean','=', true)
            ->where('user_id_send_towards_accepted_boolean','=', false)
            ->first();
        if($chatAlreadyPending){
            return false;
        }

        $chatAlreadyPendingBooleanTrue = Chat::where('user_id_belongs_to','=', auth()->user()->id)
            ->where('user_id_send_towards', '=', $id)
            ->where('user_id_belongs_to_accepted_boolean','=', true)
            ->where('user_id_send_towards_accepted_boolean','=', true)
            ->first();
        if($chatAlreadyPendingBooleanTrue){
            return false;
        }

        $chatAlreadyPendingBooleanTrue2 = Chat::where('user_id_belongs_to','=', $id)
            ->where('user_id_send_towards', '=', auth()->user()->id)
            ->where('user_id_belongs_to_accepted_boolean','=', true)
            ->where('user_id_send_towards_accepted_boolean','=', true)
            ->first();
        if($chatAlreadyPendingBooleanTrue2){
            return false;
        }

        $chatExist = Chat::where('user_id_send_towards', '=', $id)
            ->where('user_id_belongs_to','=', auth()->user()->id)
            ->first();
        if($chatExist){
            return false;
        }
        return true;
    }

    public static function CheckChatRequest()
    {
        return Chat::all()
        ->where('user_id_send_towards', '=', auth()->user()->id)
        ->where('user_id_belongs_to_accepted_boolean','=', true)
        ->where('user_id_send_towards_accepted_boolean','=', false);
    }


    public function user()
    {

        return $this->belongsTo('App\User');

    }
}
