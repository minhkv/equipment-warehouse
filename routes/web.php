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

Route::get('/combo', function() {
    return view('combo');
})->name('combo');

Route::get('/combo/{id}', function() {
    return view('combo-detail');
})->name('combo-detail');

Route::get('/order', function() {
    return view('order');
})->name('order');

Route::get('/order/{id}', function() {
    return view('order-detail');
})->name('order-detail');

Route::get('/create-order', function() {
    return view('create-order');
})->name('create-order');

Route::get('/create-equipment', function() {
    return view('create-equipment');
})->name('create-equipment');

Route::get('/create-combo', function() {
    return view('create-combo');
})->name('create-combo');

Route::get('/borrowing-cart', function() {
    return view('borrowing-cart');
})->name('borrowing-cart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([    
    'category' => 'CategoryController',
    'combo' => 'ComboController',
    'equipment' => 'EquipmentController',
    'equipment-template' => 'EquipmentTemplateController',
    'order' => 'OrderController',
]);

Route::resource('borrowed-history', 'BorrowedHistoryController')->only([
    'index'
]);
Route::resource('channel', 'ChannelController')->only([
    'index'
]);
Route::resource('supplier', 'SupplierController')->only([
    'index'
]);
Route::resource('usage-history', 'UsageHistoryController')->only([
    'index'
]);