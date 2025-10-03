<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

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

    // Dashboard
    Route::get('/', function () {
        $barangMasuk = BarangMasuk::count();
        $barangKeluar = BarangKeluar::count();

        return view('dashboard', compact('barangMasuk', 'barangKeluar'));
    })->name('dashboard');

    Route::get('/dashboard', function () {
        $barangMasuk = BarangMasuk::count();
        $barangKeluar = BarangKeluar::count();

        return view('dashboard', compact('barangMasuk', 'barangKeluar'));
    });

    // Barang Routes
    Route::get('/barang-masuk', [BarangController::class, 'indexBarangMasuk'])->name('barang-masuk');
    Route::post('/barang/masuk', [BarangController::class, 'storeBarangMasuk'])->name('barang.store');

    Route::get('/barang-keluar', [BarangController::class, 'indexBarangKeluar'])->name('barang-keluar');
    Route::post('/barang/keluar', [BarangController::class, 'storeBarangKeluar'])->name('barang-keluar.store');

    Route::get('/data-barang', [BarangController::class, 'indexDataBarang'])->name('data-barang');
    Route::get('/stok-barang', [BarangController::class, 'indexStokBarang'])->name('stok-barang');

    Route::put('/data-barang/{id}', [BarangController::class, 'updateDataBarang'])->name('data-barang.update');
    Route::delete('/data-barang/{id}', [BarangController::class, 'destroyDataBarang'])->name('data-barang.destroy');

});
