<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\UserController;

Route::redirect('/', '/login');

// AREA PUBLIK //
// Route untuk Login
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
});

// AREA INTERNAL //
Route::middleware(['auth'])->group(function (){

    // Route untuk Register
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');

    // Halaman Dashboard Utama
    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
    Route::get('/kasir', [DashboardController::class, 'kasir'])->name('kasir');

    // === ROUTE MASTER DATA CABANG ===
    Route::get('/cabang', [CabangController::class, 'index'])->name('cabang.index');
    Route::get('/cabang/tambah', [CabangController::class, 'create'])->name('cabang.create');
    Route::post('/cabang', [CabangController::class, 'store'])->name('cabang.store');

    // === ROUTE MASTER DATA USER ===
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/tambah', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Halaman Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});