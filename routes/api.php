<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::post('/register','RegisterController@register');
//Auth::routes(['register' => false]);

Route::post('/register','ApiController@register');
Route::post('/login','ApiController@login');
Route::post('/refresh','ApiController@refresh');
Route::post('/logout','ApiController@logout');
