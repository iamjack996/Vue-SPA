<?php

use App\Http\Controllers\PostController;
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

Route::get('/posts','PostController@index');
Route::get('/posts/{post}','PostController@show');

Route::post('/register','Auth\RegisterController@register');




// Http
Route::get('/http/getHttpIndexData','Test\HttpController@getHttpIndexData')->name('test.http.getHttpIndexData');
Route::get('/http/getCityDat','Test\HttpController@getCityData')->name('test.http.getCityData');

// Socket
Route::get('/socket/getSocketIndexData','Test\SocketController@getSocketIndexData')->name('test.socket.getSocketIndexData');
Route::post('/socket/newMsg','Test\SocketController@newMsg')->name('test.socket.newMsg');
