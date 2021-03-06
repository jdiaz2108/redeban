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
    Route::get('/', 'RootController');

    Route::post('/change-password', 'Auth\ChangePasswordController')->name('change.password');

    // Only users with user role
    Route::group(['middleware' => ['role:user']], function () {


        Route::post('/updateDataPoints', 'UpdateUserDataController@addPoints');
        Route::resource('/update-data', 'UpdateUserDataController')->only(['index', 'store', 'update']);


        // Update data is required
        Route::middleware('update.data')->group(function () {

            Route::get('/shop', 'HomeController@showShops');
            Route::get('/home', 'HomeController@showShops');

            Route::get('/selectShop/{id}', 'HomeController@selectShop');

            Route::get('/prize/{id}', 'HomeController@showPrize');

            Route::middleware('current.shop')->group(function () {
                Route::get('/catalog', 'HomeController@catalog');
                Route::resource('/redeem-validate-mail', 'RedeemValidateMailController')->only(['store', 'update']);
                Route::get('/points', 'HomeController@points');
                Route::get('/transactions', 'HomeController@transactions');
                Route::get('/coupons', 'HomeController@redeem');
            });

        });

        Route::post('/contact', 'ContactController@store');
        Route::get('/json/department/{id}', 'HomeController@JsonCities');
        Route::get('/about', 'HomeController@about');
        Route::get('/terms', 'HomeController@terms');
    });

    // Only users with admin role included prefix dashboard
    Route::group(['middleware' => ['role:admin']], function () {

        Route::get('/dashboard', 'HomeController@index')->name('dash');

        // Prefix dashboard to use admin role
        Route::group(['prefix' => 'dashboard', 'as' => 'admin::'], function() {

            Route::resource('/coupons', 'CouponController')->only(['index']);
            Route::get('coupons/{coupon}/changeState', 'CouponController@toggleState');
            Route::get('/coupons-download', 'CouponController@download');

            Route::resource('/shops', 'ShopController')->only(['index', 'store']);

            Route::resource('/prizes', 'PrizeController')->only(['index', 'create' ,'store', 'edit','update', 'destroy']);

            Route::resource('/fulfillments', 'FulfillmentController')->only(['index', 'create' , 'edit', 'update', 'store', 'destroy']);

            Route::resource('/prize-category', 'PrizeCategoryController')->only(['store']);

            Route::get('/liquidation', 'PointController@liquidation')->name('liquidation');
            Route::resource('/points', 'PointController')->only(['index']);


            Route::resource('/users', 'UserController')->only(['index', 'create', 'store']);

            Route::resource('/contacts', 'ContactController')->only(['index', 'show']);

            Route::get('/csv', 'CSVFileImporter@downloadFulfillmentsCsv');
            Route::get('/csv-fulfillments-base', 'CSVFileImporter@fulfillmentsBase')->name('fulfillment.base');
            Route::get('/csv-user-base', 'CSVFileImporter@userBase')->name('user.base');
            Route::get('/reports-admin', 'UserController@reportAdmin');

            Route::resource('/histories', 'CSVFileImporter')->only(['index']);

            Route::get('gettingPoints', 'PointController@gettingPoints')->name('user.point');
            Route::get('activeUsersReport', 'UserController@activeUsersReport');
            Route::get('inactiveUsersReport', 'UserController@inactiveUsersReport');

            Route::resource('rewards', 'RewardController');
            Route::resource('trivias', 'TriviaController');
            Route::get('trivias/{trivia}/changeStateTrivia', 'TriviaController@toggleTriviaState');
        });
    });
});
Route::get('/tyc', 'TestController@tyc');

Auth::routes();

Route::get('/test/welcome', 'TestController@welcome');
Route::get('/test/send-code', 'TestController@sendCode');
Route::get('/test/redeem-prize', 'TestController@redeemPrize');
Route::get('/test/restore-password', 'TestController@restorePassword');
Route::get('/test/send-contact', 'TestController@contacts');
