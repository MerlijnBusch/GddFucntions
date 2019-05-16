<?php

namespace App\Http\Controllers\Moderator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Metric;

class ModeratorController extends Controller
{
    public function __construct()
    {

        $this->  middleware('auth');
        $this->middleware('is_moderator');

    }

    public function index()
    {

        $metrics = Metric::all();
        return view('moderator.dashboard.index',compact('metrics'));

    }

    public function metric_show(Metric $metric)
    {
//        $metric_php_array = json_decode($metric->data_json_version);
//        dd($metric_php_array);
        return view('moderator.functions.edit',compact('metric'));
    }

    public function store_cvs_to_json(Request $request){

        $ext     = explode('.', $request->input('file_name'));
        $ext_len = count($ext) - 1;
        $my_ext  = $ext[$ext_len];
        if($my_ext != 'csv'){
            abort(403, 'Unauthorized action.');
        }

        if(Metric::all()->where('file_name',  $request->input('file_name'))->first()){
            return back()->withErrors(['Error File already exist']);
        }

        $input = trim($request->input('cvs_to_json_text'));
        if ((substr($input, 0, 1) == '{' && substr($input, -1) == '}') or (substr($input, 0, 1) == '[' && substr($input, -1) == ']')) {
            $output = json_decode($input, 1);
            if (in_array(gettype($output),['object','array'])) {
                $metric = new Metric();
                $metric->file_name          =  $request->input('file_name');
                $metric->data_json_version  =  json_encode($output);
                $metric->save();
                return back()->withMessage('csv file is saved to the database');
            }
        }
        return back()->withErrors(['Error failed to upload']);
    }

    public function destroy_metric(Metric $metric)
    {
        $metric->delete();
        return back()->withMessage('Story successfully deleted');
    }
}
