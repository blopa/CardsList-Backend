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

// List all cards list
Route::get('list', 'CardsListController@index');

// List single card list
Route::get('list', 'CardsListController@show');

// Create new cards list
Route::post('list', 'CardsListController@create');

// Update cards list
Route::put('list', 'CardsListController@update');

// Delete cards list
Route::delete('list', 'CardsListController@destroy');