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
    return view('welcome');
});

//課題3
Route::group(['prefix' => 'XXX'], function() {
    Route::get('XXX', 'XXX\AAAController@bbb');
});

//課題４
Route::group(['prefix' => 'Admin'], function() {
    Route::get('profile/create', 'Admin\NewsController@add');
    Route::get('profile/edit', 'Admin\NewsController@edit');
});