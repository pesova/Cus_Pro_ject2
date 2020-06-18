<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register errors routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "errors" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('contact', function() {
    return view('contact');
});

Route::get('login', function() {
    return view('login');
});

Route::get('about-us', function() {
    return view('about-us');
});


