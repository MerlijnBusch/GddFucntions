<?php

namespace App\Http\Controllers;

use App\Metric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MetricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metrics = Metric::select('file_name', 'id')->get();
        return view('metric.index', compact('metrics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Metric  $metric
     * @return \Illuminate\Http\Response
     */
    public function show(Metric $metric)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Metric  $metric
     * @return \Illuminate\Http\Response
     */
    public function edit(Metric $metric)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Metric  $metric
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metric $metric)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Metric  $metric
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metric $metric)
    {
        //
    }

    public function ajaxMetric()
    {
        if(request()->ajax()){

            $arrayData = Input::get('data');
            $arrayData = json_decode($arrayData, true);

            $i = 0;
            foreach ($arrayData as $value) {
                $arrayData[$i] = strtr ($value, array ('_' => ','));
                $i++;
            }

            $arrayWithKeys = [];
            foreach($arrayData as $value){
                $tmpArray = explode(',',trim($value));
                if(count($tmpArray) > 1) {
                    unset($tmpArray[count($tmpArray)-1]);
                    $tmpArray = implode(",", $tmpArray);
                    $arrayWithKeys[] = array_search($tmpArray, $arrayData);
                }
            }

            foreach ($arrayWithKeys as $keys){
                unset($arrayData[$keys]);
            }
            $arrayData = array_values($arrayData);

            $queryData = [];
            foreach ($arrayData as $data){
                $queryData[] = Metric::where('file_name','LIKE',$data . '%')->get();
            }

            return response()->json(['status' => 'success', 'message' => $queryData]);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'an error occurred']);
        }
    }
}
