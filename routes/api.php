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
Route::get('/register/github', 'SocialController@getGithubAuth');
Route::get('/register/github/callback', 'SocialController@getGithubCallback');

Route::get('/register/google', 'SocialController@getGoogleAuth');
Route::get('/register/google/callback', 'SocialController@getGoogleCallback');

Route::any('/register/linkedin', 'SocialController@getLinkedInAuth');
Route::any('/register/linkedin/callback', 'SocialController@getLinkedInCallback');

Route::any('/register/OK', 'SocialController@getOKAuth');
Route::any('/register/OK/callback', 'SocialController@getOKCallback');

Route::any('/register/VK', 'SocialController@getVKAuth');
Route::any('/register/VK/callback', 'SocialController@getVKCallback');

Route::any('/register/facebook', 'SocialController@getFacebookAuth');
Route::any('/register/facebook/callback', 'SocialController@getFacebookCallback');

Route::any('/register/twitter', 'SocialController@getTwitterAuth');
Route::any('/register/twitter/callback', 'SocialController@getTwitterCallback');

Route::post('/register', 'AuthController@register')->name('register');
Route::post('/login', 'AuthController@login')->name('login');

Route::get('/login', 'AuthController@login')->name('getLogin');
Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::get('/base', 'BaseController@getIndex');
    Route::post('/logout', 'AuthController@logout');
});

