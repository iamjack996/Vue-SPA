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

Route::get('index', 'Test\HttpController@index')->name('test.http.index');
Route::post('testSubmit', 'Test\HttpController@testSubmit')->name('test.http.testSubmit');

Route::get('{path}', function () {
    return view('layouts.master');
})->where(['path' => '.*']);

