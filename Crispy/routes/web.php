<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('login'); });
Route::get('/sales', [\App\Http\Controllers\SalesController::class, 'index']);
Route::get('/sales/create', [\App\Http\Controllers\SalesController::class, 'create'])->name('sales.create');
Route::post('/sales', [\App\Http\Controllers\SalesController::class, 'store'])->name('sales.store');
Route::get('/sales/{sale}/edit', [\App\Http\Controllers\SalesController::class, 'edit'])->name('sales.edit');
Route::put('/sales/{sale}', [\App\Http\Controllers\SalesController::class, 'update'])->name('sales.update');
Route::delete('/sales/{sale}', [\App\Http\Controllers\SalesController::class, 'destroy'])->name('sales.destroy');
Route::get('/reservations', [\App\Http\Controllers\ReservationsController::class, 'index']);
Route::get('/reservations/create', [\App\Http\Controllers\ReservationsController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [\App\Http\Controllers\ReservationsController::class, 'store'])->name('reservations.store');
Route::get('/reservations/{reservation}/edit', [\App\Http\Controllers\ReservationsController::class, 'edit'])->name('reservations.edit');
Route::put('/reservations/{reservation}', [\App\Http\Controllers\ReservationsController::class, 'update'])->name('reservations.update');
Route::delete('/reservations/{reservation}', [\App\Http\Controllers\ReservationsController::class, 'destroy'])->name('reservations.destroy');
Route::get('/menu', [\App\Http\Controllers\MenuController::class, 'index']);
Route::get('/menu/create', [\App\Http\Controllers\MenuController::class, 'create'])->name('menu.create');
Route::post('/menu', [\App\Http\Controllers\MenuController::class, 'store'])->name('menu.store');
Route::get('/menu/{menu}/edit', [\App\Http\Controllers\MenuController::class, 'edit'])->name('menu.edit');
Route::put('/menu/{menu}', [\App\Http\Controllers\MenuController::class, 'update'])->name('menu.update');
Route::delete('/menu/{menu}', [\App\Http\Controllers\MenuController::class, 'destroy'])->name('menu.destroy');
Route::get('/kitchen', [\App\Http\Controllers\KitchenController::class, 'index']);
Route::get('/kitchen/create', [\App\Http\Controllers\KitchenController::class, 'create'])->name('kitchen.create');
Route::post('/kitchen', [\App\Http\Controllers\KitchenController::class, 'store'])->name('kitchen.store');
Route::get('/kitchen/{kitchen}/edit', [\App\Http\Controllers\KitchenController::class, 'edit'])->name('kitchen.edit');
Route::put('/kitchen/{kitchen}', [\App\Http\Controllers\KitchenController::class, 'update'])->name('kitchen.update');
Route::delete('/kitchen/{kitchen}', [\App\Http\Controllers\KitchenController::class, 'destroy'])->name('kitchen.destroy');
Route::get('/inventory', [\App\Http\Controllers\InventoryController::class, 'index']);
Route::get('/inventory/create', [\App\Http\Controllers\InventoryController::class, 'create'])->name('inventory.create');
Route::post('/inventory', [\App\Http\Controllers\InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory/{inventory}/edit', [\App\Http\Controllers\InventoryController::class, 'edit'])->name('inventory.edit');
Route::put('/inventory/{inventory}', [\App\Http\Controllers\InventoryController::class, 'update'])->name('inventory.update');
Route::delete('/inventory/{inventory}', [\App\Http\Controllers\InventoryController::class, 'destroy'])->name('inventory.destroy');
Route::get('/employees', [\App\Http\Controllers\EmployeesController::class, 'index']);
Route::get('/employees/create', [\App\Http\Controllers\EmployeesController::class, 'create'])->name('employees.create');
Route::post('/employees', [\App\Http\Controllers\EmployeesController::class, 'store'])->name('employees.store');
Route::get('/employees/{employee}/edit', [\App\Http\Controllers\EmployeesController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{employee}', [\App\Http\Controllers\EmployeesController::class, 'update'])->name('employees.update');
Route::delete('/employees/{employee}', [\App\Http\Controllers\EmployeesController::class, 'destroy'])->name('employees.destroy');
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);

// Authentification
Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', function () { return view('register'); })->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
