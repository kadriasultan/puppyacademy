<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DagopvangController;
use Illuminate\Support\Facades\Auth;

Auth::routes();


// ✅ Dashboard route (alleen voor ingelogde gebruikers)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ✅ Dagopvang routes (GET en POST)
Route::get('/dagopvang', [DagopvangController::class, 'index'])->middleware('auth')->name('dagopvang');
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
