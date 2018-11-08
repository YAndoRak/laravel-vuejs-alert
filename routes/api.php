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
Route::group(['middleware'=>['auth:api']], function(){
    Route::get('/post/{id}','AcceuilController@show');
    Route::post('/post/edit/{id}','PostController@update');

    Route::post('/upload_image', 'UploadController@UploadImage');
    Route::post('/upload_video', 'UploadController@UploadVideo');
    Route::post('/upload_file', 'UploadController@UploadFile');
});