    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\BarangMasukController;
    use App\Http\Controllers\BarangKeluarController;
    use App\Models\BarangMasuk;
    use App\Models\BarangKeluar;
    use App\Http\Controllers\Api\ProductController;


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

        // ========== BARANG ROUTES (CRUD) ==========

        // Barang Masuk
        Route::get('/barang-masuk', [BarangMasukController::class, 'indexBarangMasuk'])->name('barang-masuk');
        Route::post('/barang-masuk', [BarangMasukController::class, 'storeBarangMasuk'])->name('barang-masuk.store');

        // Barang Keluar
        Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar');
        Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barang-keluar.store');

        // Data & Stok Barang
        Route::get('/data-barang', [BarangMasukController::class, 'indexDataBarang'])->name('data-barang');
        Route::get('/stok-barang', [BarangMasukController::class, 'indexStokBarang'])->name('stok-barang');

        // Update dan Hapus Data Barang
        Route::put('/data-barang/{id}', [BarangMasukController::class, 'updateDataBarang'])->name('data-barang.update');
        Route::delete('/data-barang/{id}', [BarangMasukController::class, 'destroyDataBarang'])->name('data-barang.destroy');
    });
