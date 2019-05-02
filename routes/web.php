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

Route::get('/', function () {
    return view('layouts.master');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('metric', 'MetricController');
Route::resource('story', 'StoryController');

Route::post('/ajax-metric-update','MetricController@ajaxMetric')->name('ajax-metric-update');
Route::post('/ajax-story-search','StoryController@ajaxSearch')->name('ajax-story-search');

Route::get('/admin', 'Admin\AdminController@index')
    ->middleware('is_admin')
    ->name('admin.index');
Route::get('/moderator', 'Moderator\ModeratorController@index')
    ->middleware('is_moderator')
    ->name('moderator.index');

Route::get('/user/profile/{user}', 'UserProfileController@index')->name('user_profile')->middleware('auth');