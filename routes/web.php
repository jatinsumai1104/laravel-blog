<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/blog', 'WebController\BlogController@index');

Route::get('/blog/create', 'WebController\BlogController@create')->middleware('auth');
Route::post('/blog/create', 'WebController\BlogController@store')->middleware('auth');

Route::get('/blog/{blog}', 'WebController\BlogController@show');

Route::get('/blog/{blog}/edit', 'WebController\BlogController@edit')->middleware('auth');
Route::put('/blog/{blog}/edit', 'WebController\BlogController@update')->middleware('auth');

Route::get('/blog/user/{user}', 'WebController\BlogController@postsByUser');
Route::get('/blog/tag/{tag}', 'WebController\BlogController@postsByTag');
