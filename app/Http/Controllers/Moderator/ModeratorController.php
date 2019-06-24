<?php

namespace App\Http\Controllers\Moderator;

use App\Moderator;
use App\Story;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Metric;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Sassnowski\LaravelShareableModel\Shareable\ShareableLink;

class ModeratorController extends Controller
{
    //Checks where ever the user is logged in
    //Checks where ever the user is a moderator
    //Custom middleware
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('is_moderator');

    }

    //returns openings moderator page
    public function index()
    {

        $metrics = Metric::paginate(20);
        $story = Story::all();
        return view('moderator.dashboard.index',compact('metrics','story'));

    }

    //Shows and metric where you can edit the page
    public function metric_show(Metric $metric)
    {

        return view('moderator.functions.edit',compact('metric'));

    }

    //Store the uploaded csv file to json in the database
    public function store_cvs_to_json(Request $request){

        //Check if the file is a csv file
        $validatedFile = Moderator::getFileType($request->input('file_name'));
        if($validatedFile != 'csv'){
            abort(403, 'Unauthorized action.');
        }

        //checks if file already exist
        if(Metric::all()->where('file_name',  $request->input('file_name'))->first()){
            return back()->withErrors(['Error File already exist']);
        }

        //Checks if the file is an json file
        $validatedJson = Moderator::checkIfStringIsJson($request->input('cvs_to_json_text'));
        if($validatedJson !== true){
            return back()->withErrors(['Error failed to upload']);
        }

        //Upload into the database
        $metric = new Metric();
        $metric->file_name          =  $request->input('file_name');
        $metric->data_json_version  =  $request->input('cvs_to_json_text');
        $metric->save();

        //Return back to the upload page with success status message
        return back()->withMessage('csv file is saved to the database');

    }

    //Upade the csv file
    public function update_cvs_to_json(Request $request)
    {

        //Checks if the file is an json file
        $validatedJson = Moderator::checkIfStringIsJson($request->input('json_stringify_edit_csv'));
        if($validatedJson !== true){
            return back()->withErrors(['Error failed to upload']);
        }

        //Checks if the file exist
        if(!Metric::all()->where('file_name',  $request->input('form_title_csv_edit'))->first()){
            return back()->withErrors(['Error This files does not exist yet!']);
        }

        //Find the database spot and update it with the request data
        $metric = Metric::all()->where('file_name',  $request->input('form_title_csv_edit'))->first();
        $metric->data_json_version  =  $request->input('json_stringify_edit_csv');
        $metric->update();

        //return back and success status
        return back()->withMessage('Updated and saved in the database');
    }

    //Delete the metric out of the database
    public function destroy_metric(Metric $metric)
    {
        $metric->delete();
        return back()->withMessage('Story successfully deleted');
    }

    //Show the page where you create a persona
    public function create_persona()
    {
        return view('moderator.partial-pages.persona.create');
    }

    //Function that validates and stores the persona
    public function store_persona(Request $request)
    {
        $validated = $request->validate([
            'persona_title_form' => 'min:10|max:255|string',
            'persona_body_form' => 'min:60|max:3000|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'second_persona_title_form' => 'min:10|max:255|string',
            'second_persona_body_form' => 'min:30|max:3000|string',
        ]);

        $validatedJson = Moderator::checkIfStringIsJson($request->input('json_data_bar_charts'));
        if($validatedJson !== true){
            return back()->withErrors(['Error failed to upload']);
        }

        if(strlen($request->input('json_data_bar_charts')) < 15){
            return back()->withErrors(['add some charts!? other wise it doesnt look cool ;(']);
        }

        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploadedImages'), $new_name);

        $story = new Story;
        $story->title = $validated['persona_title_form'];
        $story->description = $validated['persona_body_form'];
        $story->json = $request->input('json_data_bar_charts');
        $story->second_title = $validated['second_persona_title_form'];
        $story->second_description = $validated['second_persona_body_form'];
        $story->path = $new_name;
        $story->save();

        return back()->withMessage('Persona posted!');
    }

    //return the edit form page of the persona
    public function edit_persona(Story $story)
    {
        return view('moderator.partial-pages.persona.edit',compact('story'));
    }

    //generate an active link where you can send the persona's with
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

    //Delete the persona
    public function delete_persona(Story $story)
    {
        $image_path = public_path()."/uploadedImages/".$story->path;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $story->delete();

        return back()->withMessage('Story successfully deleted');
    }

    //toggle between setting the story on Accepted, Pending or Declined
    public function display_story(Request $request, Story $story)
    {
        $x = '';
        if($story->accepted == 'true'){ $x = $request->input('accepted_select');}
        if($story->accepted == 'false'){ $x = $request->input('pending_select');}
        if($story->accepted == 'declined'){ $x = $request->input('declined_select');}
        $story->accepted = $x;
        $story->update();
        return back()->withMessage('Persona display successfully updated');
    }
}
