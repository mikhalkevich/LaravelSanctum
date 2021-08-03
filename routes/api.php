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
Route::get('/register/google', 'SocialController@getGoogleAuth');
Route::get('/register/google/callback', 'SocialController@getGoogleCallback');

Route::any('/register/linkedin', 'SocialController@getLinkedInAuth');
Route::any('/register/linkedin/callbac4k', 'SocialController@getLinkedInCallback');

Route::post('/register', 'AuthController@register')->name('register');
Route::post('/login', 'AuthController@login')->name('login');

Route::get('/login', 'AuthController@login')->name('getLogin');
Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::get('/base', 'BaseController@getIndex');
    Route::post('/logout', 'AuthController@logout');
});

