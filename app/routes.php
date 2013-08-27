<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::resource('polls', 'PollsController');

Route::resource('answers', 'AnswersController');

Route::resource('votes', 'VotesController');


# Index Page - Last route, no matches
Route::get('/',  array('as' => 'homePage', 'uses' => 'PollsController@index'));