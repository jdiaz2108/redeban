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

// Auth is required
Route::middleware('auth')->group(function () {

    // Redirect user if has any role
    Route::get('/', function () {
        if (Auth::check()) {
            if (Auth::user()->hasAnyRole('admin')) {
                return redirect('dashboard');
            }
            elseif(Auth::user()->hasAnyRole('user')) {
                return redirect('home');
            }
        }
    });
    
    // Only users with user role
    Route::group(['middleware' => ['role:user']], function () {
        
        Route::resource('/update-data', 'UpdateUserDataController')->only(['index', 'store', 'update']);
        
        // Update data is required
        Route::middleware('update.data')->group(function () {

            Route::get('/home', 'HomeController@index')->name('home');
            Route::resource('/prizes', 'PrizeController')->only(['index', 'show']);
            Route::resource('/redeem-validate-mail', 'RedeemValidateMailController')->only(['store', 'update']);
            Route::resource('/points', 'PointController')->only(['index']);
            
        });
    });
        
    // Only users with admin role included prefix dashboard
    Route::group(['middleware' => ['role:admin']], function () {
        
        Route::get('/dashoboard', 'HomeController@index')->name('dash');
        
        // Prefix dashboard to use admin role
        Route::group(['prefix' => 'dashboard'], function() {
            
            Route::resource('/prizes', 'AdminPrizeController', ['as' => 'admin'])->only(['index', 'create' ,'store', 'destroy']);
            Route::resource('/fulfillments', 'FulfillmentController')->only(['index', 'create' ,'store', 'destroy']);
            Route::resource('/users', 'AdminUserController')->only(['index']);
            
        });
    });
});

Auth::routes();

