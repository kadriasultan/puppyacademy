<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Http\Controllers\IntakeController;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


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

Route::middleware(['auth'])->group(function () {
    Route::put('/admin/owner-section/{id}', [HomeController::class, 'update']);
});
Route::post('/admin/owner-section/upload-image/{id}', [HomeController::class, 'uploadImage']);

Route::get('/dagopvang/bedankt', function () {
    return view('dagopvang.bedankt');
})->name('dagopvang.bedankt');

// Voeg deze toe bij je andere routes:
use App\Http\Controllers\AppointmentController;

// Zorg dat deze route bestaat:
Route::post('/afspraak/maken', [AppointmentController::class, 'maakAfspraak'])
    ->name('afspraak.maken');
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



// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'index')->name('profile');
        Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/{userId}', 'showProfile');

    });

    // Dogs resource
    Route::resource('dogs', DogController::class);


    // Shop routes
    Route::controller(ShopController::class)->prefix('shop')->group(function () {
        Route::post('/', 'store')->name('shop.store');
        Route::put('/{id}', 'update')->name('shop.update');
        Route::delete('/{id}', 'destroy')->name('shop.destroy');
    });
    Route::controller(ShopController::class)->prefix('payment')->group(function () {
        Route::get('/', 'showPaymentPage')->name('payment');
        Route::post('/', 'processPayment')->name('payment.process');
    });
    // Training routes
    Route::controller(TrainingController::class)->prefix('training')->group(function () {
        Route::post('/', 'store')->name('training.store');
        Route::put('/{id}', 'update')->name('training.update');
        Route::delete('/{id}', 'destroy')->name('training.destroy');
        Route::post('/register', 'register')->name('training.register');
    });
    // Admin dashboard
    Route::get('/dashboard', function () {
        return auth()->user()->role !== 'admin' ? redirect('/') : view('admin.dashboard');
    })->name('dashboard');
});
    // Dagopvang



    Route::post('/dagopvang', [DagopvangController::class, 'store'])->name('dagopvang.store');


Route::controller(DagopvangController::class)->prefix('dagopvang.payment')->group(function () {
    Route::get('/', 'intakepayment')->name('dagopvang.payment');
    Route::post('/', 'processintakepayment')->name('payment.intake');;
});


require __DIR__.'/auth.php';
