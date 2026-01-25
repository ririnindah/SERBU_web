<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LowStockController;
use App\Http\Controllers\SerbuController;
use App\Http\Controllers\HighProductivityController;
use App\Http\Controllers\LowProductivityController;
use App\Models\HighProductivity;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/login', function () {
    return view('login');
});

Route::middleware('auth.session')->group(function () {
    Route::get('/serbu', [SerbuController::class, 'index']);

    Route::get('/low-stock', [LowStockController::class, 'index']);

    Route::get('/high-productivity', [HighProductivityController::class, 'index']);

    Route::get('/low-productivity', [LowProductivityController::class, 'index']);

    Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');
});
