<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemSoldController;
use App\Http\Controllers\ItemAddedController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ReportController;

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes requiring authentication
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home.index');
    })->name('home');
    Route::resource('items', ItemController::class);
    Route::resource('item_sold', ItemSoldController::class);
    Route::resource('item_added', ItemAddedController::class);
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/reports', [ReportController::class,'index'])->name('reports');
    Route::post('/reports', [ReportController::class,'download'])->name('reports.download');
});