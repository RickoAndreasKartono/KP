<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemasokController;

Route::get('/', [HomeController::class, 'index']);

// Auth routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login_post', [AuthController::class, 'login_post']);

Route::get('forgot', [AuthController::class, 'forgot'])->name('forgot');
Route::post('forgot_post', [AuthController::class, 'forgot_post'])->name('forgot_post');

Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('password.update');

Route::get('validate_forgot_pass/{token}', [AuthController::class, 'validate_forgot_pass'])->name('validate_forgot_pass');
Route::post('validate_forgot_pass_post', [AuthController::class, 'validate_forgot_pass_post'])->name('validate_forgot_pass_post');

// Routes for Owner only
Route::group(['middleware' => 'owner'], function () {
    Route::get('owner/stok_pupuk', [DashboardController::class, 'stokPupuk'])->name('owner.stok_pupuk');
    Route::get('owner/stok_masuk', [DashboardController::class, 'stokMasuk'])->name('owner.stok_masuk');
    Route::get('owner/stok_masuk/add_pupuk', [StokMasukController::class, 'create'])->name('owner.add_stok_masuk');
    Route::post('owner/stok_masuk/store', [StokMasukController::class, 'store'])->name('owner.store_stok_masuk');
    Route::get('owner/stok_keluar', [DashboardController::class, 'stokKeluar'])->name('owner.stok_keluar');
    Route::get('owner/laporan_stok', [DashboardController::class, 'laporanStok'])->name('owner.laporan_stok');
    Route::get('owner/manajemen_pembelian', [DashboardController::class, 'manajemenPembelian'])->name('owner.manajemen_pembelian');
    Route::get('owner/validasi_transaksi', [DashboardController::class, 'validasiTransaksi'])->name('owner.validasi_transaksi');
    Route::get('owner/kelola_user', [DashboardController::class, 'kelolaUser'])->name('owner.kelola_user');

    // User Management
    Route::get('owner/kelola_user/add', [UserController::class, 'create'])->name('owner.kelola_user.add');
    Route::post('owner/kelola_user/add', [UserController::class, 'store'])->name('owner.kelola_user.store');
    Route::post('owner/kelola_user/update-role/{id}', [UserController::class, 'updateRole'])->name('owner.kelola_user.update_role');
    Route::delete('owner/kelola_user/delete/{id}', [UserController::class, 'destroy'])->name('owner.kelola_user.delete');

    Route::get('owner/profile_settings', [DashboardController::class, 'profileSettings'])->name('owner.profile_settings');
});

// Routes for Manager
Route::group(['middleware' => 'manager'], function () {
    Route::get('manager/stok_pupuk', [DashboardController::class, 'stokPupuk'])->name('manager.stok_pupuk');
    // Tambahkan route lain sesuai kebutuhan
});

Route::group(['middleware' => 'kepala_admin'], function () {
    Route::get('kepala_admin/stok_pupuk', [DashboardController::class, 'stokPupuk'])->name('kepala_admin.stok_pupuk');
    Route::get('kepala_admin/stok_masuk', [DashboardController::class, 'stokMasuk'])->name('kepala_admin.stok_masuk');
    Route::get('kepala_admin/stok_keluar', [DashboardController::class, 'stokKeluar'])->name('kepala_admin.stok_keluar');
    Route::get('kepala_admin/laporan_stok', [DashboardController::class, 'laporanStok'])->name('kepala_admin.laporan_stok');
    Route::get('kepala_admin/manajemen_pembelian', [DashboardController::class, 'manajemenPembelian'])->name('kepala_admin.manajemen_pembelian');
    Route::get('kepala_admin/validasi_transaksi', [DashboardController::class, 'validasiTransaksi'])->name('kepala_admin.validasi_transaksi');
    Route::get('kepala_admin/pemasok', [DashboardController::class, 'pemasok'])->name('kepala_admin.pemasok');
    
    Route::get('kepala_admin/pemasok/add', [PemasokController::class, 'create'])->name('kepala_admin.pemasok.add');
    Route::post('kepala_admin/pemasok/add', [PemasokController::class, 'store'])->name('kepala_admin.pemasok.store');
    Route::post('kepala_admin/pemasok/update-role/{id}', [PemasokController::class, 'updateRole'])->name('kepala_admin.pemasok.update_role');
    Route::delete('kepala_admin/pemasok/delete/{id}', [PemasokController::class, 'destroy'])->name('kepala_admin.pemasok.delete');

    Route::get('kepala_admin/profile_settings', [DashboardController::class, 'profileSettings'])->name('kepala_admin.profile_settings');
});

Route::group(['middleware' => 'kepala_gudang'], function () {
    Route::get('kepala_gudang/stok_pupuk', [DashboardController::class, 'stokPupuk'])->name('kepala_gudang.stok_pupuk');
    // Tambahkan route lain sesuai kebutuhan
});

// Logout
Route::get('logout', [AuthController::class, 'logout']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
