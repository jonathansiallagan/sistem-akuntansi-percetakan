<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// AREA PUBLIK //
// Route untuk Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

// AREA INTERNAL //
Route::middleware(['auth'])->group(function (){

    // Route untuk Register
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');

    // Halaman Dashboard Utama
    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
    Route::get('/kasir', [DashboardController::class, 'kasir'])->name('kasir');
});