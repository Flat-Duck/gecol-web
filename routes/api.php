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


Route::name("api.")->namespace('API')->group(function () {
     Route::post('/login', 'AuthController@login');

     Route::group(['middleware' => ['auth:api']], function () {

         Route::get('main', 'HomeController@main');
         Route::get('readings', 'HomeController@readings');
         Route::get('notices', 'HomeController@notices');

     //   Route::get('/password', 'HomeController@updatePassword');
     //   Route::post('/password', 'HomeController@updatePassword');
        
     });
});
