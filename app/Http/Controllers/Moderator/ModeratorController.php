<?php

namespace App\Http\Controllers\Moderator;

use App\Moderator;
use App\Story;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Metric;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Sassnowski\LaravelShareableModel\Shareable\ShareableLink;

class ModeratorController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('is_moderator');

    }

    public function index()
    {

        $metrics = Metric::all();
        $story = Story::all();
        return view('moderator.dashboard.index',compact('metrics','story'));

    }

    public function metric_show(Metric $metric)
    {

        return view('moderator.functions.edit',compact('metric'));

    }

    public function store_cvs_to_json(Request $request){

        $validatedFile = Moderator::getFileType($request->input('file_name'));
        if($validatedFile != 'csv'){
            abort(403, 'Unauthorized action.');
        }

        if(Metric::all()->where('file_name',  $request->input('file_name'))->first()){
            return back()->withErrors(['Error File already exist']);
        }

        $validatedJson = Moderator::checkIfStringIsJson($request->input('cvs_to_json_text'));
        if($validatedJson !== true){
            return back()->withErrors(['Error failed to upload']);
        }

        $metric = new Metric();
        $metric->file_name          =  $request->input('file_name');
        $metric->data_json_version  =  $request->input('cvs_to_json_text');
        $metric->save();
        return back()->withMessage('csv file is saved to the database');

    }

    public function update_cvs_to_json(Request $request)
    {

        $validatedJson = Moderator::checkIfStringIsJson($request->input('json_stringify_edit_csv'));
        if($validatedJson !== true){
            return back()->withErrors(['Error failed to upload']);
        }

        if(!Metric::all()->where('file_name',  $request->input('form_title_csv_edit'))->first()){
            return back()->withErrors(['Error This files does not exist yet!']);
        }
        $metric = Metric::all()->where('file_name',  $request->input('form_title_csv_edit'))->first();
        $metric->data_json_version  =  $request->input('json_stringify_edit_csv');
        $metric->update();

        return back()->withMessage('Updated and saved in the database');
    }

    public function destroy_metric(Metric $metric)
    {
        $metric->delete();
        return back()->withMessage('Story successfully deleted');
    }

    public function create_persona()
    {
        return view('moderator.partial-pages.persona.create');
    }

    public function store_persona(Request $request)
    {
        $validated = $request->validate([
            'persona_title_form' => 'min:10|max:255|string',
            'persona_body_form' => 'min:60|max:3000|string',

        ]);

        $validatedJson = Moderator::checkIfStringIsJson($request->input('json_data_bar_charts'));
        if($validatedJson !== true){
            return back()->withErrors(['Error failed to upload']);
        }

        if(strlen($request->input('json_data_bar_charts')) < 15){
            return back()->withErrors(['add some charts!? other wise it doesnt look cool ;(']);
        }

        $story = new Story;
        $story->title = $validated['persona_title_form'];
        $story->description = $validated['persona_body_form'];
        $story->json = $request->input('json_data_bar_charts');
        $story->save();

        return back()->withMessage('Persona posted!');
    }

    public function edit_persona(Story $story)
    {
        return view('moderator.partial-pages.persona.edit',compact('story'));
    }

    public function share_persona(Story $story)
    {
        $hash = base64_encode(Hash::make($story->id . time() . Config::get('APP_KEY')));

        $link = ShareableLink::buildFor($story)
            ->setPassword($hash)
            ->setActive()
            ->build();

        $sharedLink = $link->url;
        return view('moderator.partial-pages.persona.share', compact('sharedLink', 'hash'));

    }

    public function delete_persona(Story $story)
    {
        $story->delete();

        return back()->withMessage('Story successfully deleted');
    }
}
