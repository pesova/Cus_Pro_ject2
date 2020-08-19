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

Route::middleware('api.auth')->group(function () {
    Route::group('/store', function () {
        Route::post('/customers/{store_id}', 'CustomersController@index');
        Route::post('/debts/{store_id}', 'CustomersController@index');
        Route::post('/payments/{store_id}', 'CustomersController@index');
        Route::post('/credits/{store_id}', 'CustomersController@index');
    });

    // Route::get('stores', '');
    // Route::get('/customer/{customer_id}', '');
    // Route::get('/payment/{payment_id}', '');
    // Route::get('/debt/{debt_id}', '');
    // Route::get('/credit/{credit_id}', '');
});
