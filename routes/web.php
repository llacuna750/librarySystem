<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController; // <-- add this line

// Public Route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (protected)    
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar/remove', [ProfileController::class, 'removeAvatar'])->name('profile.avatar.remove');

    // Resource routes
    Route::resource('suppliers', SupplierController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);

    // PDF Routes
    Route::get('/orders-pdf', [OrderController::class, 'exportPdfAll'])->name('orders.pdf');
    Route::get('/orders-pdf/{id}', [OrderController::class, 'exportPdf'])->name('orders.pdf.individual');
});

Route::get('/orders/export-pdf', [OrderController::class, 'exportPdfAll'])->name('orders.exportPdfAll');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::resource('customers', CustomerController::class);
require __DIR__ . '/auth.php';
