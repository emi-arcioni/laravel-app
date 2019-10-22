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

Route::get('/', 'HomeController@show');

// -- LOGIN --
Route::get('/login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('/login', 'Auth\LoginController@login');
// --

// -- LOGOUT --
Route::get('/logout', 'Auth\LoginController@logout');
// --

// -- REGISTER --
Route::group(['middleware' => ['guest']], function () {
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('/register', 'Auth\RegisterController@register');
});
// --

Route::get('/users/{user_id}/entries', 'EntryController@index');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/users/{user_id}/edit', 'Auth\RegisterController@edit');
    Route::put('/users/{user_id}', 'Auth\RegisterController@update');

    Route::get('/users/{user_id}/entries/create', 'EntryController@create');
    Route::get('/users/{user_id}/entries/{entry_id}/edit', 'EntryController@edit');
    Route::post('/users/{user_id}/entries', 'EntryController@store');
    Route::put('/users/{user_id}/entries/{entry_id}', 'EntryController@update');

    // TODO: move this endpoint to de API endpoints
    Route::delete('/users/{user_id}/entries/{entry_id}', 'EntryController@destroy');
});