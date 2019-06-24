<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DistricOverview;
use Illuminate\Support\Facades\Input;

class DistricOverviewController extends Controller
{
    //Return the index page
    public function index()
    {
        return view('district.index');
    }

    //return data on user input not working cuz we had to fake it for the presentation
    public function ajax_request_data()
    {
        if(request()->ajax()){

            $input = Input::get('data');
            $data = DistricOverview::getData($input);

            return response()->json(['status' => 'success', 'message' => $data]);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'an error occurred']);
        }
    }
}
