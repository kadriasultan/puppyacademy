<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DagopvangController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// ✅ Dagopvang routes (GET en POST)
Route::get('/dagopvang', [DagopvangController::class, 'index'])->name('dagopvang');
Route::post('/dagopvang', [DagopvangController::class, 'store'])->middleware('auth')->name('dagopvang.store');

// ✅ Shop route
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// ✅ Training route
Route::get('/training', [TrainingController::class, 'index'])->name('training');

// ✅ Contact routes (GET en POST)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ✅ Home route (optioneel, naar je homepage)
Route::get('/', function () {
    return view('welcome');
});
// Payment page route (GET)
Route::get('/payment', [ShopController::class, 'showPaymentPage'])->middleware('auth')->name('payment');

// Process payment route (POST)
Route::post('/payment', [ShopController::class, 'processPayment'])->name('payment.process');
