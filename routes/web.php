<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemSoldController;
use App\Http\Controllers\ItemAddedController;
use App\Http\Controllers\Auth\LoginController;

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes requiring authentication
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('templates.homepage');
    })->name('home');
    Route::resource('items', ItemController::class);
    Route::resource('item_sold', ItemSoldController::class);
    Route::resource('item_added', ItemAddedController::class);
});