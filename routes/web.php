<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DagopvangController;
use App\Http\Controllers\Auth\RegisterController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/dagopvang', [DagopvangController::class, 'index'])->name('dagopvang');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/training', [TrainingController::class, 'index'])->name('training');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/{userId}', [ProfileController::class, 'showProfile']);
    });

    // Dogs resource
    Route::resource('dogs', DogController::class);

    // Shop routes
    Route::post('/shop', [ShopController::class, 'store'])->name('shop.store');
    Route::put('/shop/{id}', [ShopController::class, 'update'])->name('shop.update');
    Route::delete('/shop/{id}', [ShopController::class, 'destroy'])->name('shop.destroy');

    // Training routes
    Route::post('/training', [TrainingController::class, 'store'])->name('training.store');
    Route::put('/training/{id}', [TrainingController::class, 'update'])->name('training.update');
    Route::delete('/training/{id}', [TrainingController::class, 'destroy'])->name('training.destroy');
    Route::post('/training/register', [TrainingController::class, 'register'])->name('training.register');

    // Dagopvang
    Route::post('/dagopvang', [DagopvangController::class, 'store'])->name('dagopvang.store');

    // Payment routes
    Route::get('/payment', [ShopController::class, 'showPaymentPage'])->name('payment');
    Route::post('/payment', [ShopController::class, 'processPayment'])->name('payment.process');

    // Admin dashboard
    Route::get('/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
