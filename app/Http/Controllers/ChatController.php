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

            return response()->json(['status' => 'success', 'message' => $input]);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'an error occurred']);
        }

    }
}
