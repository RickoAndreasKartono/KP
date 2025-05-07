<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\StokController;

Route::get('/', function () {
    return view('landing');
});

// Login dan Logout
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Reset Password
Route::get('/reset_password', [ResetPasswordController::class, 'showResetForm'])->name('password.request');
Route::post('/password/update', [ResetPasswordController::class, 'updatePassword'])->name('password.update');

// Rute untuk akses umum (semua pengguna yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/stok_pupuk', function () {
        return view('dashboard.stok_pupuk'); // Tampilkan dashboard utama
    })->name('stok_pupuk');

    Route::get('/home', function () {
        return view('home.index');
    });

    // Laporan Stok
    Route::get('/laporan-stok', [StokController::class, 'laporan'])->name('laporan.stok');

    // Stok Masuk
    Route::view('/stok_masuk', 'dashboard.stok_masuk')->name('stok_masuk');

    // Stok Kluar
    Route::view('/stok_keluar', 'dashboard.stok_keluar')->name('stok_keluar');
});

// Akses Berdasarkan Role
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::resource('admin/user', UserController::class); // Kelola User untuk Admin
    Route::view('/kelola_user', 'dashboard.kelola_user')->name('kelola_user');
});

Route::middleware(['auth', 'role:kepala_gudang'])->group(function () {
    Route::view('/stok_masuk', 'dashboard.stok_masuk')->name('stok_masuk');
    Route::view('/stok_keluar', 'dashboard.stok_keluar')->name('stok_keluar');
});


// Tambahan Debug
Route::get('/check-db', function () {
    return DB::connection()->getDatabaseName();
});
