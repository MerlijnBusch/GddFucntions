<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Story;

class UserProfileController extends Controller
{
    public function index(User $user)
    {

        if($user->id != auth()->user()->id){
            abort(403, 'Unauthorized action.');
        }

        $story = Story::all()->where('user_id', '=', $user->id);
        return view('profile.index',compact('user','story'));

    }
}
