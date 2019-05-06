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
        $story->body_json = json_encode($request->story_add_body_to_story_hidden_json);
        $story->user_id = auth()->user()->id;
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
        return 'edit';
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
        return $story;
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

    public function share(Story $story)
    {
        if($story->user_id != auth()->user()->id){
            abort(403, 'Unauthorized action.');
        }

        $hash = base64_encode(Hash::make($story->id . Config::get('APP_KEY')));

        $link = ShareableLink::buildFor($story)
            ->setPassword($hash)
            ->setActive()
            ->build();

        $sharedLink = $link->url;
        return view('story.partials.sharedLinkDisplay', compact('sharedLink', 'hash'));

    }

}
