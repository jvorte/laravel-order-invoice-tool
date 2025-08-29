<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () { return view('welcome'); });
Route::get('/demo', [OrderController::class,'demo']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/orders', [AdminController::class,'orders'])->name('orders.index');
    Route::get('/invoices', [AdminController::class,'invoices'])->name('invoices.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [AdminController::class,'orders'])->name('orders.index');
    Route::get('/orders/{order}', [AdminController::class,'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [AdminController::class,'edit'])->name('orders.edit'); // admin only
    Route::patch('/orders/{order}', [AdminController::class,'update'])->name('orders.update'); // admin only
    Route::delete('/orders/{order}', [AdminController::class,'destroy'])->name('orders.destroy'); // admin only
});

Route::middleware(['auth'])->group(function () {
    // Invoices
    Route::get('/invoices', [AdminController::class,'invoices'])->name('invoices.index');
    Route::get('/invoices/{invoice}', [AdminController::class,'showInvoice'])->name('invoices.show');
    Route::get('/invoices/{invoice}/download', [AdminController::class,'downloadInvoice'])->name('invoices.download');
});

Route::get('/demo', [OrderController::class,'demo']);

require __DIR__.'/auth.php';
