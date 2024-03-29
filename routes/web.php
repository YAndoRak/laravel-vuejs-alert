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
Route::get('/', 'AcceuilController@index');

Route::get('acceuil', 'AcceuilController@index');

Route::get('form', 'PostController@form');
Route::post('form', 'PostController@poster');

Route::get('api', 'AcceuilController@api');
Route::get('/account', 'UserController@index')->name('account');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('post/{id}', 'AcceuilController@detail');
Route::get('post/edit/{id}', 'PostController@edit')->name('post.edition');