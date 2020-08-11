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