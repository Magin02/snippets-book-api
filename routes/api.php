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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('api')->name('api.')->group(function(){

    Route::prefix('/auth')->namespace('Auth')->group(function (){
         Route::post('/login', 'AuthController@login');
         Route::get('/logout', 'AuthController@logout');
         Route::post('/register', 'RegisterController@store');
    });

    Route::prefix('/profile')->namespace('profile')->group(function (){
        Route::get('/{id}', 'ProfileController@show')->name('profile.show');
        Route::put('/{id}', 'ProfileController@update')->name('profile.update');
        Route::post('/{id}/follow', 'ProfileController@follow');

    });

    Route::prefix('/skill')->namespace('skill')->group(function (){
        Route::get('/', 'SkillController@index');
        Route::post('/{id}', 'SkillController@store')->name('skill.store');
    });
});


