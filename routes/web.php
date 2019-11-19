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

Route::get('boot/{id}', function ($id){
    return '获取一本书,他的ID是'.$id;
});

Route::get('boots/{name?}', function ($name= 'book one'){
    return '获取一本书,它的书名'.$name;
});

Route::put('boot', function (){
    return '新增一本书';
});

Route::delete('boot', function (){
    return '删除一本书';
});

Route::patch('boot', function (){
    return '获取一本书';
});

Route::post('boot', function (){
    return 'POST 一本书';
});

Route::get('/coding', 'Coding10Controller@select');
Route::get('/video', 'Coding10Controller@select_id');
Route::get('/vo_url', 'Coding10Controller@video_id');
Route::get('/search','Coding10Controller@search');

Route::post('/card', 'CardController@show');
