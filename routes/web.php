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

Route::get('/borrowing-cart', function() {
    return view('borrowing-cart');
})->name('borrowing-cart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([    
    'category' => 'CategoryController',
    'channel' => 'ChannelController',
    'combo' => 'ComboController',
    'equipment' => 'EquipmentController',
    'equipment-template' => 'EquipmentTemplateController',
    'order' => 'OrderController',
    'supplier' => 'SupplierController'
]);

Route::resource('borrowed-history', 'BorrowedHistoryController')->only([
    'index'
]);

Route::resource('usage-history', 'UsageHistoryController')->only([
    'index'
]);