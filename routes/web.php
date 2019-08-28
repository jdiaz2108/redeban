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

    Route::resource('/update-data', 'UpdateUserDataController')->only(['index', 'store', 'update']);
    Route::resource('/prizes', 'PrizeController')->only(['index', 'show']);
    Route::resource('/redeem-validate-mail', 'RedeemValidateMailController')->only(['store']);

    Route::group(['prefix' => 'dashboard'], function() {
        Route::resource('/prizes', 'Admin\PrizeController')->only(['index', 'create' ,'store', 'destroy']);
    });
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

