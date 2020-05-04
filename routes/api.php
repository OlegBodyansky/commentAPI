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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'v1'], function () {
    Route::get('/', 'CommentsController@index');
    Route::get('post/{post_id}/list','CommentsController@list');
    Route::get('/posts','CommentsController@postList');
    Route::get('comment/{id}/edit', 'CommentsController@edit');
    Route::post('comment/create', 'CommentsController@store');
    Route::post('comment/update', 'CommentsController@update');
    Route::post('comment/{id}/delete', 'CommentsController@destroy');
});
