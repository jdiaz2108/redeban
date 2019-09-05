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
        if (Auth::user()->hasAnyRole('admin')) {
            return redirect('dashboard');
        }
        elseif(Auth::user()->hasAnyRole('user')) {
            return redirect('home');
        }
    });

    // Only users with user role
    Route::group(['middleware' => ['role:user']], function () {

        Route::resource('/home', 'UpdateUserDataController')->only(['index', 'store', 'update']);

        // Update data is required
        Route::middleware('update.data')->group(function () {

            Route::get('/catalog', 'HomeController@catalog');
            Route::get('/prize/{id}', 'HomeController@showPrize');
            Route::resource('/redeem-validate-mail', 'RedeemValidateMailController')->only(['store', 'update']);
            Route::get('/points', 'HomeController@points');
            Route::get('/transactions', 'HomeController@transactions');

        });

        Route::get('/about', 'HomeController@about');
        Route::get('/terms', 'HomeController@terms');
    });

    // Only users with admin role included prefix dashboard
    Route::group(['middleware' => ['role:admin']], function () {

        Route::get('/dashboard', 'HomeController@index')->name('dash');

        // Prefix dashboard to use admin role
        Route::group(['prefix' => 'dashboard', 'as' => 'admin::'], function() {

            Route::resource('/prizes', 'PrizeController')->only(['index', 'create' ,'store', 'destroy']);
            Route::resource('/fulfillments', 'FulfillmentController')->only(['index', 'create' , 'edit', 'update', 'store', 'destroy']);

            Route::post('/findUsers', 'UserController@searchUser')->name('find.users');
            Route::resource('/users', 'UserController')->only(['index', 'create', 'store']);

            Route::get('/csv', 'CSVFileimporter@download');
        });
    });
});

Auth::routes();
