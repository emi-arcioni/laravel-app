<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/users/{user_id}/tweets/{tweet_id}/hide', 'TwitterController@hideTweet');
    Route::delete('/users/{user_id}/tweets/{tweet_id}/hide', 'TwitterController@unhideTweet');

    Route::delete('/users/{user_id}/entries/{entry_id}', 'EntryController@destroy');
});

Route::get('/users/{user_id}/tweets', 'TwitterController@getTweets');