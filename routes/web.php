<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Http\Controllers\{
    ProfileController,
    ShopController,
    TrainingController,
    ContactController,
    HomeController,
    DagopvangController,
    Auth\RegisterController,
    DogController,
    AdminController
};

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dagopvang', [AdminController::class, 'manageDagopvang'])->name('admin.manageDagopvang');
});

// Public routes
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('welcome');
});

Route::controller(DagopvangController::class)->group(function () {
    Route::get('/dagopvang', 'index')->name('dagopvang');
});

Route::controller(ShopController::class)->group(function () {
    Route::get('/shop', 'index')->name('shop');
});

Route::controller(TrainingController::class)->group(function () {
    Route::get('/training', 'index')->name('training');
});

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact');
    Route::post('/contact', 'send')->name('contact.send');
});

// Registration routes
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'index')->name('profile');
        Route::get('/edit', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/{id}', 'destroy')->name('profile.destroy');
        Route::get('/{userId}', 'showProfile');
    });

    // Dogs resource
    Route::resource('dogs', DogController::class)->except(['show']); // Exclude show if not needed

    // Shop routes
    Route::controller(ShopController::class)->prefix('shop')->group(function () {
        Route::post('/', 'store')->name('shop.store');
        Route::put('/{id}', 'update')->name('shop.update');
        Route::delete('/{id}', 'destroy')->name('shop.destroy');
    });

    // Training routes
    Route::controller(TrainingController::class)->prefix('training')->group(function () {
        Route::post('/', 'store')->name('training.store');
        Route::put('/{id}', 'update')->name('training.update');
        Route::delete('/{id}', 'destroy')->name('training.destroy');
        Route::post('/register', 'register')->name('training.register');
    });

    // Dagopvang
    Route::post('/dagopvang', [DagopvangController::class, 'store'])->name('dagopvang.store');

    // Payment routes
    Route::controller(ShopController::class)->prefix('payment')->group(function () {
        Route::get('/', 'showPaymentPage')->name('payment');
        Route::post('/', 'processPayment')->name('payment.process');
    });

    // Admin dashboard
    Route::get('/dashboard', function () {
        return auth()->user()->role !== 'admin' ? redirect('/') : view('admin.dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
