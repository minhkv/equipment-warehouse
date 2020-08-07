<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/equipment', function() {
    return view('equipment');
})->name('equipment');

Route::get('/equipment/{id}', function() {
    return view('equipment-detail');
})->name('equipment-detail');

Route::get('/combo/{id}', function() {
    return view('combo-detail');
})->name('combo-detail');

Route::get('/order', function() {
    return view('order');
})->name('order');

Route::get('/create-equipment', function() {
    return view('create-equipment');
})->name('create-equipment');

Route::get('/borrowing-cart', function() {
    return view('borrowing-cart');
})->name('borrowing-cart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
