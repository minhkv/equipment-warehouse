<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
    // Route::resource('equipment-template', 'EquipmentTemplateController')->only(['index', 'show']);    
    Route::resource('order', 'OrderController')->only(['index', 'show', 'create']);
    Route::post('order-request', 'OrderController@storeRequest')->name('order-request.store');
    Route::resource('category', 'CategoryController')->only(['index']);
    
    Route::resource('user', 'Admin\UserController')->middleware('can:modify-users')->except(['show', 'create', 'store']);
    Route::middleware('can:modify-items')->group(function() {
        Route::get('/', 'HomeController@index');
        Route::get('/home', 'HomeController@index')->name('home');

        Route::resource('equipment', 'EquipmentController');

        Route::resource('equipment-template', 'EquipmentTemplateController');//->except(['index', 'show',]);

        Route::resource('order', 'OrderController')->except(['index', 'show', 'create']);
        Route::resource('category', 'CategoryController')->except(['index']);
        Route::resource('department', 'DepartmentController');
        Route::resource('supplier', 'SupplierController');
        Route::resource('input-order', 'InputOrderController');
        Route::get('equipment-template-lost', 'EquipmentController@equipmentLost')->name('equipment-template.lost');
        Route::put('equipment-template-lost-received/{equipment}', 'EquipmentController@receivedLostEquipment')->name('equipment-template.received-lost');
        Route::put('order-request/{order}/accept', 'OrderController@acceptOrderRequest')->name('order-request.accept');
        Route::put('order-request/{order}/reject', 'OrderController@rejectOrderRequest')->name('order-request.reject');
        Route::put('order-request/{order}/output', 'OrderController@equipmentOutput')->name('order-request.output');
        Route::put('order-request/{order}/return', 'OrderController@equipmentReturn')->name('order-request.return');
        Route::put('order-request/{order}/complete', 'OrderController@completeOrder')->name('order-request.complete');
        Route::put('order-request/{order}/back', 'OrderController@back')->name('order-request.back');
    });

    Route::get('/test', function() {
        $equipmentTemplates= App\EquipmentTemplate::with('equipments')->where('display', 1)->get();
        $suppliers = App\Supplier::all();
        $categories = App\Category::with('templates')->get();
        return view('test')->with([
            'categories' => $categories,
            'suppliers' => $suppliers,
            'equipmentTemplates' => $equipmentTemplates
        ]);
    });
});
