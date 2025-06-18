<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Routes d'authentification
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes protégées par l'authentification
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Gestion du menu
    Route::get('/menu', [AdminController::class, 'menu'])->name('menu');
    
    // Gestion des commandes
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/kitchen', [AdminController::class, 'kitchen'])->name('kitchen');
    
    // Programme de fidélité
    Route::get('/loyalty', [AdminController::class, 'loyalty'])->name('loyalty');
    
    // Gestion du stock
    Route::get('/stock', [AdminController::class, 'stock'])->name('stock');
    
    // Ventes et rapports
    Route::get('/sales', [AdminController::class, 'sales'])->name('sales');
    
    // Gestion des employés
    Route::get('/employees', [AdminController::class, 'employees'])->name('employees');
}); 