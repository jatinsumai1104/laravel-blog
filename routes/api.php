<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'ApiController\AuthController@login');
    Route::post('signup', 'ApiController\AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'ApiController\AuthController@logout');
        Route::get('user', 'ApiController\AuthController@user');
        Route::put('/blog/{blog}', 'ApiController\BlogController@update');
        Route::delete('/blog/{blog}', 'ApiController\BlogController@delete');
    });
});

Route::get('/blog', 'ApiController\BlogController@index');

Route::post('/blog', 'ApiController\BlogController@store');

Route::get('/blog/{blog}', 'ApiController\BlogController@show');

Route::get('/blog/user/{user}', 'ApiController\BlogController@postsByUser');
Route::get('/blog/tag/{tag}', 'ApiController\BlogController@postsByTag');
