<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DagopvangController;




Route::get('/dashboard', function () {
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::post('/shop', [ShopController::class, 'store'])->name('shop.store');
Route::put('/shop/{id}', [ShopController::class, 'update'])->name('shop.update');
Route::delete('/shop/{id}', [ShopController::class, 'destroy'])->name('shop.destroy');


Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    // View profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Edit profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Delete account
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

Route::post('/training/register', [TrainingController::class, 'register'])->name('training.register');

// ✅ Contact routes (GET en POST)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


// Payment page route (GET)
Route::get('/payment', [ShopController::class, 'showPaymentPage'])->middleware('auth')->name('payment');

// Process payment route (POST)
Route::post('/payment', [ShopController::class, 'processPayment'])->name('payment.process');


