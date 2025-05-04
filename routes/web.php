<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DagopvangController;
use App\Http\Controllers\AdminController;

// Middleware voor geauthenticeerde gebruikers
Route::middleware(['auth'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

Route::post('/shop', [ShopController::class, 'store'])->name('shop.store');
Route::put('/shop/{id}', [ShopController::class, 'update'])->name('shop.update');
Route::delete('/shop/{id}', [ShopController::class, 'destroy'])->name('shop.destroy');

Route::post('/training', [TrainingController::class, 'store'])->name('training.store');
Route::put('/training/{id}', [TrainingController::class, 'update'])->name('training.update');
Route::delete('/training/{id}', [TrainingController::class, 'destroy'])->name('training.destroy');


    // Profiel routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dagopvang routes
    Route::get('/dagopvang', [DagopvangController::class, 'index'])->name('dagopvang');
    Route::post('/dagopvang', [DagopvangController::class, 'store'])->name('dagopvang.store');

    // Shop routes
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');

    // Training routes
    Route::get('/training', [TrainingController::class, 'index'])->name('training');
    Route::post('/training/register', [TrainingController::class, 'register'])->name('training.register');

    // Contact routes
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

    // Payment routes
    Route::get('/payment', [ShopController::class, 'showPaymentPage'])->name('payment');
    Route::post('/payment', [ShopController::class, 'processPayment'])->name('payment.process');
});

// Admin routes met middleware voor authenticatie en admin rol


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard'); // Dashboard
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users'); // Lijst van gebruikers
    Route::get('/admin/users/create', [AdminController::class, 'createUser '])->name('admin.users.create'); // Nieuwe gebruiker aanmaken
    Route::post('/admin/users', [AdminController::class, 'storeUser '])->name('admin.users.store'); // Opslaan nieuwe gebruiker
    Route::get('/admin/users/edit/{id}', [AdminController::class, 'editUser '])->name('admin.users.edit'); // Bewerken gebruiker
    Route::post('/admin/users/update/{id}', [AdminController::class, 'updateUser '])->name('admin.users.update'); // Bijwerken gebruiker
});
// Home route
Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Auth routes
require __DIR__.'/auth.php';
