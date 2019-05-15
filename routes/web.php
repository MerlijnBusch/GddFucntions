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
    return view('layouts.master');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('metric', 'MetricController');
Route::resource('story', 'StoryController');

Route::post('/ajax-metric-update','MetricController@ajaxMetric')->name('ajax-metric-update');
Route::post('/ajax-story-search','StoryController@ajaxSearch')->name('ajax-story-search');

Route::get('/user/profile/{user}', 'UserProfileController@index')->name('user_profile')->middleware('auth');
Route::put('/story/share/{story}', 'StoryController@share')->name('story.share');

Route::get('shared/{shareable_link}', ['middleware' => 'shared', function (ShareableLink $link) {
    $data = $link->shareable;
    return view('story.sharedStory',compact('data'));
}]);

Route::get('/admin', 'Admin\AdminController@index')->name('admin.index');
Route::get('/moderator', 'Moderator\ModeratorController@index')->name('moderator.index');
