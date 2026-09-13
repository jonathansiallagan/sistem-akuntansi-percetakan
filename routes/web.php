<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// AUTHENTICATION ROUTES
// Route untuk Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

// Route untuk Register (yang sudah kamu buat sebelumnya)
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

// Halaman Dashboard Utama
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
    Route::get('/kasir', [DashboardController::class, 'kasir'])->name('kasir');
});