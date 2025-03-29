<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\BookingController;


// Authentication Routes
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('/my_login', [AuthController::class, 'showLoginForm'])->name('my_login');
Route::post('/my_login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/booking', [BookingController::class, 'showForm'])->name('booking.form');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
