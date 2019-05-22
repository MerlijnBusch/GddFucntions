<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Story;
use Illuminate\Support\Facades\Input;

class UserProfileController extends Controller
{
    public function index(User $user)
    {
        if($user->id != auth()->user()->id){
            abort(403, 'Unauthorized action.');
        }
        $story = Story::where('user_id', '=', $user->id)->paginate(4);
        return view('profile.index',compact('user','story'));
    }

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
