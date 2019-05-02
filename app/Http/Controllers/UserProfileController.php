<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserProfileController extends Controller
{
    public function index(User $user)
    {

        $user = auth()->user();
        return view('profile.index',compact('user'));

    }
}
