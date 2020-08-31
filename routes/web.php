<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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



Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/borrowing-cart', function() {
        return view('borrowing-cart');
    })->name('borrowing-cart');
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
    
    Route::resource('combo-info', 'ComboInfoController')->only([
        'store', 'destroy'
    ]);
    
    Route::resource('usage-history', 'UsageHistoryController')->only([
        'index'
    ]);
    Route::get('equipment-template-lost', 'EquipmentController@equipmentLost')->name('equipment-template.lost');
    Route::put('equipment-template-lost-received/{equipment}', 'EquipmentController@receivedLostEquipment')->name('equipment-template.received-lost');
    Route::post('order-request', 'OrderController@storeRequest')->name('order-request.store');
    Route::put('order-request/{order}/accept', 'OrderController@acceptOrderRequest')->name('order-request.accept');
    Route::put('order-request/{order}/reject', 'OrderController@rejectOrderRequest')->name('order-request.reject');
    Route::put('order-request/{order}/output', 'OrderController@equipmentOutput')->name('order-request.output');
    Route::put('order-request/{order}/return', 'OrderController@equipmentReturn')->name('order-request.return');
    Route::put('order-request/{order}/complete', 'OrderController@completeOrder')->name('order-request.complete');
    Route::put('order-request/{order}/back', 'OrderController@back')->name('order-request.back');
    Route::get('/test', function() {
        $users = App\User::all();
        $equipmentTemplates = App\EquipmentTemplate::with(['equipments'])->get();
        $channels = App\Channel::all();
        $stocker_id = Auth::user()->id;
        $categories = App\Category::all();
        return view('test')->with([
            'users' => $users,
            'channels' => $channels,
            'equipmentTemplates' =>$equipmentTemplates,
            'stocker_id' => $stocker_id,
            'categories' => $categories
        ]);
    });
});
