<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Sassnowski\LaravelShareableModel\Shareable\ShareableLink;

Route::get('/', function () {
    return view('layouts.index');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('metric', 'MetricController');
Route::resource('story', 'StoryController');

Route::post('/ajax-metric-update','MetricController@ajaxMetric')->name('ajax-metric-update');
Route::post('/ajax-story-search','StoryController@ajaxSearch')->name('ajax-story-search');

Route::get('/user/profile/{user}', 'UserProfileController@index')->name('user_profile')->middleware('auth');
Route::post('/user/profile/search','UserProfileController@search_user')->name('user.profile.search');
Route::put('/story/share/{story}', 'StoryController@share')->name('story.share');

Route::post('/chat/startChat/user/', 'ChatController@FindUser')->name('chat.startChat.user');
Route::put('/chat/request/accept/{chat}', 'ChatController@AcceptChatRequest')->name('chat.request.accept');
Route::delete('/chat/request/destroy/{chat}', 'ChatController@DestroyChatRequest')->name('chat.request.destroy');
Route::put('/chat/message/create/{conversation_id}','ChatController@StoreChatMessage')->name('chat.message.create');

Route::get('/district','DistricOverviewController@index')->name('district.index');
Route::post('/district/ajax-request-data','DistricOverviewController@ajax_request_data')->name('district.ajax-request-data');

Route::get('shared/{shareable_link}', ['middleware' => 'shared', function (ShareableLink $link) {
    $data = $link->shareable;
    return view('story.sharedStory',compact('data'));
}]);

Route::get('/admin', 'Admin\AdminController@index')->name('admin.index');


Route::get('/moderator', 'Moderator\ModeratorController@index')->name('moderator.index');
Route::get('/moderator/metric/show/{metric}', 'Moderator\ModeratorController@metric_show')->name('moderator.metric.show');
route::get('/moderator/persona/create','Moderator\ModeratorController@create_persona')->name('moderator.persona.create');
Route::get('/moderator/persona/edit/{story}','Moderator\ModeratorController@edit_persona')->name('moderator.persona.edit');
Route::put('/moderator/persona/share/{story}','Moderator\ModeratorController@share_persona')->name('moderator.persona.share');
Route::post('/moderator/persona/update/displaying/{story}','Moderator\ModeratorController@display_story')->name('moderator.persona.update.display');
Route::delete('/moderator/persona/delete/{story}','Moderator\ModeratorController@delete_persona')->name('moderator.persona.destroy');
route::post('/moderator/persona/store','Moderator\ModeratorController@store_persona')->name('moderator.persona.store');
Route::put('/moderator/store/cvs_to_json','Moderator\ModeratorController@store_cvs_to_json')->name('moderator.store.cvs_to_json');
Route::put('/moderator/update/cvs_to_json','Moderator\ModeratorController@update_cvs_to_json')->name('moderator.update.cvs_to_json');
Route::delete('/moderator/destroy/metric/{metric}','Moderator\ModeratorController@destroy_metric')->name('moderator.destroy.metric');

