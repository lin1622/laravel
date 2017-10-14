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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('get', function () {
    dd('aaaa');
});

//Route::get('user/{id}', function ($id) {
//    return 'User ' . $id;
//});


Route::group(['middleware'=>['blog']],function(){
    Route::get('/', function () {
        return view('welcome', ['website' => 'Laravel']);
    });
//    Route::get('/view', function () {
//        return view('welcome', ['website' => 'Laravel学院']);
//    });

    Route::view('/view', 'welcome', ['website' => 'Laravel学院']);
});

Route::get('user/{id}', 'UserController@show');
Route::resource('posts', 'PostController');
Route::resource('post', 'PostController', ['only' =>
    ['index', 'show']
]);

Route::resource('post', 'PostController', ['except' =>
    ['create', 'store', 'update', 'destroy']
]);
Route::apiResource('post', 'PostController');