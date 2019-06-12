<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DistricOverview;
use Illuminate\Support\Facades\Input;

class DistricOverviewController extends Controller
{
    public function index()
    {
        return view('district.index');
    }

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
