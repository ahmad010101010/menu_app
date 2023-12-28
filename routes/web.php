<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Api\MenuApiController;
use App\Http\Controllers\Api\MenuController as ApiMenuController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('adminq')->middleware(['auth','isAdmin'])->group(function(){

    Route::get('dashboard', [App\Http\Controllers\Admin\DashbardeController::class, 'index']);

    Route::resource('menu', MenuController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('item', ItemController::class);
    Route::resource('discount', DiscountController::class);



    
    });