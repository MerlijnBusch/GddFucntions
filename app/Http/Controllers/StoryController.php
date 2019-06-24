<?php

namespace App\Http\Controllers;

use App\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Sassnowski\LaravelShareableModel\Shareable\ShareableLink;


class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'ajaxSearch','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $story = Story::where('accepted', 'true')
            ->get();

        return view('story.index',compact('story'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        return view('story.single',compact('story'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {

    }

    //Search function that searches in the database on ajax request
    public function ajaxSearch()
    {
        if(request()->ajax()){

            $input = Input::get('data');
            if(!isset($input)){
                return response()->json(['status' => 'success', 'message' => '']);
            }
            $story = Story::where('title', 'LIKE', $input . '%')
                ->where('accepted', 'true')
                ->get();
            return response()->json(['status' => 'success', 'message' => $story]);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'an error occurred']);
        }
    }

    public function share(Story $story)
    {

    }

}
