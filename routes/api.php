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

Route::get('categories/get','MovieController@getCategory');

Route::group([ 'middleware' => 'api','prefix' => 'movie'], function () {
    Route::post('get', 'MovieController@getMovie');
    Route::post('create', 'MovieController@store');
});