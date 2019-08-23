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
Route::middleware('auth')->group(function () {

    Route::resource('/update-data', 'UpdateUserData')->only(['index', 'store', 'update']);

    Route::middleware('update.data')->group(function () {

        Route::get('/', function () {
            return view('welcome');
        });
        
        Route::get('/ingreso', function () {
            return view('welcome');
        });
        Route::get('/home', 'HomeController@index')->name('home');
    });
});

Auth::routes();

