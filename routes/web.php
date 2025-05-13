<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;


Route::get('/', [HomeController::class, 'index']);

// // Route untuk login
Route::get('login', [AuthController::class, 'login']);
Route::post('login_post', [AuthController::class, 'login_post']);

Route::get('forgot', [AuthController::class, 'forgot']);

<<<<<<< HEAD
Route::group(['middleware' => 'owner'], function () {
    Route::get('owner/stok_pupuk', [DashboardController::class, 'stokPupuk'])->name('stok_pupuk');
    Route::get('owner/stok_masuk', [DashboardController::class, 'stokMasuk'])->name('stok_masuk');
    Route::get('owner/stok_keluar', [DashboardController::class, 'stokKeluar'])->name('stok_keluar');
    Route::get('owner/laporan_stok', [DashboardController::class, 'laporanStok'])->name('laporan_stok');
    Route::get('owner/manajemen_pembelian', [DashboardController::class, 'manajemenPembelian'])->name('manajemen_pembelian');
    Route::get('owner/validasi_transaksi', [DashboardController::class, 'validasiTransaksi'])->name('validasi_transaksi');
    Route::get('owner/kelola_user', [DashboardController::class, 'kelolaUser'])->name('kelola_user');
});


Route::get('/owner/kelola_user', [UserController::class, 'index'])->name('kelola_user');
Route::get('/owner/kelola_user/tambah', [UserController::class, 'create'])->name('tambah_user');
Route::post('/owner/kelola_user', [UserController::class, 'store'])->name('store_user');
Route::get('/owner/kelola_user/edit/{id}', [UserController::class, 'edit'])->name('edit_user');
Route::put('/owner/kelola_user/{id}', [UserController::class, 'update'])->name('update_user');

=======
Route::group(['middleware' => 'owner'],function () {
    Route::get('/stok_pupuk', [DashboardController::class, 'dashboard']);
});


Route::group(['middleware' => 'owner'], function () {
    Route::get('/kelola-user', [UserController::class, 'index'])->name('kelola_user.index');
    Route::get('/kelola-user/create', [UserController::class, 'create'])->name('kelola_user.create');
    Route::post('/kelola-user', [UserController::class, 'store'])->name('kelola_user.store');
    Route::get('/kelola-user/{id}/edit', [UserController::class, 'edit'])->name('kelola_user.edit');
    Route::put('/kelola-user/{id}', [UserController::class, 'update'])->name('kelola_user.update');
    Route::delete('/kelola-user/{id}', [UserController::class, 'destroy'])->name('kelola_user.destroy');
});
>>>>>>> b6cc912d5cb7ea324caa4a5973710c7953e1f963


Route::group(['middleware' => 'manager'],function () {
    Route::get('manager/stok_pupuk', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'kepala_admin'],function () {
    Route::get('kepala_admin/stok_pupuk', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'kepala_gudang'],function () {
    Route::get('kepala_gudang/stok_pupuk', [DashboardController::class, 'dashboard']);
});


// // Route untuk logout
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// // Route untuk dashboard dan halamannya (sesuai dengan role)
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard/stok_pupuk', [DashboardController::class, 'stokPupuk'])->name('dashboard.stok_pupuk');
//     Route::get('/dashboard/stok_masuk', [DashboardController::class, 'stokMasuk'])->name('dashboard.stok_masuk');
//     Route::get('/dashboard/stok_keluar', [DashboardController::class, 'stokKeluar'])->name('dashboard.stok_keluar');
//     Route::get('/dashboard/laporan_stok', [DashboardController::class, 'laporanStok'])->name('dashboard.laporan_stok');
//     Route::get('/dashboard/validasi_transaksi', [DashboardController::class, 'validasiTransaksi'])->name('dashboard.validasi_transaksi');
//     // Hanya owner yang bisa mengelola user
//     Route::middleware('role:owner')->get('/dashboard/kelola_user', [AuthController::class, 'manageUsers'])->name('dashboard.kelola_user');
// });



// // Login dan Logout

// Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// // Reset Password
// Route::get('/reset_password', [ResetPasswordController::class, 'showResetForm'])->name('password.request');
// Route::post('/password/update', [ResetPasswordController::class, 'updatePassword'])->name('password.update');

// // Rute untuk akses umum (semua pengguna yang sudah login)
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard/stok_pupuk', function () {
//         return view('dashboard.stok_pupuk'); // Tampilkan dashboard utama
//     })->name('stok_pupuk');

//     Route::get('/home', function () {
//         return view('home.index');
//     });

//     // Laporan Stok
//     Route::get('/laporan-stok', [StokController::class, 'laporan'])->name('laporan.stok');

//     // Stok Masuk
//     Route::view('/stok_masuk', 'dashboard.stok_masuk')->name('stok_masuk');

//     // Stok Kluar
//     Route::view('/stok_keluar', 'dashboard.stok_keluar')->name('stok_keluar');
// });

// // Akses Berdasarkan Role
// Route::middleware(['auth', 'role:owner'])->group(function () {
//     Route::resource('owner/users', UserController::class); // Kelola User untuk Admin
//     Route::view('/kelola_user', 'dashboard.kelola_user')->name('kelola_user');
// });

// Route::middleware(['auth', 'role:kepala_gudang'])->group(function () {
//     Route::view('/stok_masuk', 'dashboard.stok_masuk')->name('stok_masuk');
//     Route::view('/stok_keluar', 'dashboard.stok_keluar')->name('stok_keluar');
// });


// // Tambahan Debug
// Route::get('/check-db', function () {
//     return DB::connection()->getDatabaseName();
// });

// Route::get('/debug-db', function () {
//     return DB::table('users')->get();
// });
