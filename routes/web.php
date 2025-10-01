<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;

// ========== AUTH ROUTES ==========

// Login & Register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========== PROTECTED ROUTES ==========
Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Barang Routes
    Route::get('/barang-masuk', [BarangController::class, 'indexBarangMasuk'])->name('barang-masuk');
    Route::post('/barang/masuk', [BarangController::class, 'storeBarangMasuk'])->name('barang.store');

    Route::get('/barang-keluar', [BarangController::class, 'indexBarangKeluar'])->name('barang-keluar');
    Route::post('/barang/keluar', [BarangController::class, 'storeBarangKeluar'])->name('barang-keluar.store');

    Route::get('/data-barang', [BarangController::class, 'indexDataBarang'])->name('data-barang');
    Route::get('/stock-barang', [BarangController::class, 'indexStokBarang'])->name('stock-barang');
});
