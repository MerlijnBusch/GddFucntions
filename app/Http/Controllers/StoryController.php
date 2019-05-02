<?php

namespace App\Http\Controllers;

use App\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'ajaxSearch']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('story.index');
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
        $validated = $request->validate([
            'title_make_story' => 'required|min:5|max:150',
            'about' => 'required|min:100',
            'story_add_metric_to_story_hidden' => 'nullable'
        ]);

        $story = new Story;
        $story->title = $validated['title_make_story'];
        $story->body = $validated['about'];
        $story->metric_belonging_to_story = $validated['story_add_metric_to_story_hidden'];
        $story->accepted = Story::PENDING;
        $story->save();

        return back()->withMessage('Story created its pending for beeing accepted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
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
        //
    }

    public function ajaxSearch()
    {
        if(request()->ajax()){

            $input = Input::get('data');
            $story = Story::where('title', 'LIKE', '%' . $input . '%')
                ->where('accepted', 'true')
                ->get();
            return response()->json(['status' => 'success', 'message' => $story]);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'an error occurred']);
        }
    }
}
