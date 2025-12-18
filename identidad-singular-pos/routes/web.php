<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AuthController; // Asegurate de que esta línea esté

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout'); // Esta es la que faltaba

// Protegemos el sistema: solo entran si están logueados
Route::middleware(['auth'])->group(function () {
    Route::redirect('/', '/products');
    
    Route::get('products/low-stock', [ProductController::class, 'lowStock'])->name('products.lowStock');
    Route::resource('products', ProductController::class);
    Route::resource('sales', SaleController::class);
});