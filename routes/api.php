<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

// =========================
// 🔐 AUTH (Public routes)
// =========================
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/tables', [TableController::class, 'index']);


Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

// =========================
// 🔒 PROTECTED ROUTES
// =========================
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders/close', [OrderController::class, 'closeOrder']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    
    Route::put('/tables/{id}', [TableController::class, 'updateStatus']);

    Route::post('/payments', [PaymentController::class, 'pay']);
    Route::get('/payments/{orderId}/receipt', [PaymentController::class, 'receipt']);

    // =========================
    // 🧑 Pelayan Role Routes
    // =========================
    Route::middleware('role:pelayan')->group(function () {
        // Open Add Item Order
        Route::post('/orders/open', [OrderController::class, 'openOrder']);
        Route::post('/orders/add', [OrderController::class, 'addItem']);
        // Menus (CRUD)
        Route::get('/menus', [MenuController::class, 'index']);
        Route::post('/menus', [MenuController::class, 'store']);
        Route::put('/menus/{menu}', [MenuController::class, 'update']);
        Route::delete('/menus/{menu}', [MenuController::class, 'destroy']);
    });
});
