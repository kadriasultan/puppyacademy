<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DagopvangController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/training', [TrainingController::class, 'index'])->name('training');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::post('/dagopvang', [DagopvangController::class, 'store'])->name('dagopvang.store');

Route::get('/dagopvang', [DagopvangController::class, 'index'])->name('dagopvang.index');
