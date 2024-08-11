<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemSoldController;
use App\Http\Controllers\ItemAddedController;

Route::get('/', function () {
    return view('templates.homepage');
})->name('home');
Route::resource('items', ItemController::class);
Route::resource('item_sold', ItemSoldController::class);
Route::resource('item_added', ItemAddedController::class);
