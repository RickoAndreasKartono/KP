<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManajemenPembelianController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\ValidasiTransaksiController;

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
    Route::post('owner/stok_masuk/store', [StokMasukController::class, 'store'])->name('owner.store_stok_masuk');
    Route::get('owner/stok_keluar', [DashboardController::class, 'stokKeluar'])->name('owner.stok_keluar');
    Route::get('owner/laporan_stok', [DashboardController::class, 'laporanStok'])->name('owner.laporan_stok');
    Route::get('owner/manajemen_pembelian', [DashboardController::class, 'manajemenPembelian'])->name('owner.manajemen_pembelian');
    Route::get('owner/validasi_transaksi', [ValidasiTransaksiController::class, 'index'])->name('owner.validasi_transaksi');
    Route::get('owner/kelola_user', [DashboardController::class, 'kelolaUser'])->name('owner.kelola_user');

    // User Management
    Route::get('owner/kelola_user/add', [UserController::class, 'create'])->name('owner.kelola_user.add');
    Route::post('owner/kelola_user/add', [UserController::class, 'store'])->name('owner.kelola_user.store');
    Route::post('owner/kelola_user/update-role/{id}', [UserController::class, 'updateRole'])->name('owner.kelola_user.update_role');
    Route::delete('owner/kelola_user/delete/{id}', [UserController::class, 'destroy'])->name('owner.kelola_user.delete');

    Route::get('owner/profile_settings', [DashboardController::class, 'profileSettings'])->name('owner.profile_settings');
    Route::patch('owner/profile_update', [UserController::class, 'updateProfile'])->name('owner.update_profile');
});

// Routes for Manager
Route::group(['middleware' => 'manager'], function () {
    Route::get('manager/stok_pupuk', [DashboardController::class, 'stokPupuk'])->name('manager.stok_pupuk');
    Route::get('manager/stok_masuk', [DashboardController::class, 'stokMasuk'])->name('manager.stok_masuk');
    Route::get('manager/stok_keluar', [DashboardController::class, 'stokKeluar'])->name('manager.stok_keluar');
    Route::get('manager/laporan_stok', [DashboardController::class, 'laporanStok'])->name('manager.laporan_stok');
    Route::get('manager/manajemen_pembelian', [DashboardController::class, 'manajemenPembelian'])->name('manager.manajemen_pembelian');
    Route::get('manager/validasi_transaksi', [ValidasiTransaksiController::class, 'index'])->name('manager.validasi_transaksi.index');
    Route::patch('manager/validasi_transaksi/{id_validasi}/approve', [ValidasiTransaksiController::class, 'approve'])->name('manager.validasi_transaksi.approve');
    Route::patch('manager/validasi_transaksi/{id_validasi}/reject', [ValidasiTransaksiController::class, 'reject'])->name('manager.validasi_transaksi.reject'); 
    Route::get('manager/profile_settings', [DashboardController::class, 'profileSettings'])->name('manager.profile_settings');
    Route::patch('manager/profile_update', [UserController::class, 'updateProfile'])->name('manager.update_profile');
    
});

Route::group(['middleware' => 'kepala_admin'], function () {
    Route::get('kepala_admin/stok_pupuk', [DashboardController::class, 'stokPupuk'])->name('kepala_admin.stok_pupuk');
    Route::get('kepala_admin/stok_masuk', [DashboardController::class, 'stokMasuk'])->name('kepala_admin.stok_masuk');
    Route::get('kepala_admin/stok_keluar', [DashboardController::class, 'stokKeluar'])->name('kepala_admin.stok_keluar');
    Route::get('kepala_admin/laporan_stok', [DashboardController::class, 'laporanStok'])->name('kepala_admin.laporan_stok');
    Route::get('kepala_admin/profile_settings', [DashboardController::class, 'profileSettings'])->name('kepala_admin.profile_settings');
    Route::get('kepala_admin/manajemen_pembelian', [ManajemenPembelianController::class, 'index'])->name('kepala_admin.manajemen_pembelian.index');
    Route::get('kepala_admin/manajemen_pembelian/create', [ManajemenPembelianController::class, 'create'])->name('kepala_admin.manajemen_pembelian.create');
    Route::post('kepala_admin/manajemen_pembelian', [ManajemenPembelianController::class, 'store'])->name('kepala_admin.manajemen_pembelian.store');
    Route::get('kepala_admin/manajemen_pembelian/{manajemenPembelian}/edit', [ManajemenPembelianController::class, 'edit'])->name('kepala_admin.manajemen_pembelian.edit');
    Route::put('kepala_admin/manajemen_pembelian/{manajemenPembelian}', [ManajemenPembelianController::class, 'update'])->name('kepala_admin.manajemen_pembelian.update');
    Route::delete('kepala_admin/manajemen_pembelian/{manajemenPembelian}', [ManajemenPembelianController::class, 'destroy'])->name('kepala_admin.manajemen_pembelian.destroy');
    Route::get('kepala_admin/pemasok', [PemasokController::class, 'index'])->name('kepala_admin.pemasok.index');
    Route::post('kepala_admin/pemasok', [PemasokController::class, 'store'])->name('kepala_admin.pemasok.store');
    Route::get('kepala_admin/pemasok/create', [PemasokController::class, 'create'])->name('kepala_admin.pemasok.create');
    Route::get('kepala_admin/pemasok/{pemasok}/edit', [PemasokController::class, 'edit'])->name('kepala_admin.pemasok.edit');
    Route::put('kepala_admin/pemasok/{pemasok}', [PemasokController::class, 'update'])->name('kepala_admin.pemasok.update');
    Route::delete('kepala_admin/pemasok/{pemasok}', [PemasokController::class, 'destroy'])->name('kepala_admin.pemasok.destroy');
    Route::get('kepala_admin/profile_settings', [DashboardController::class, 'profileSettings'])->name('kepala_admin.profile_settings');
    Route::patch('kepala_admin/profile_update', [UserController::class, 'updateProfile'])->name('kepala_admin.update_profile');
});

Route::group(['middleware' => 'kepala_gudang'], function () {
    Route::get('kepala_gudang/stok_pupuk', [DashboardController::class, 'stokPupuk'])->name('kepala_gudang.stok_pupuk');
    Route::get('kepala_gudang/stok_masuk', [StokMasukController::class, 'index'])->name('kepala_gudang.stok_masuk.index');
    Route::get('kepala_gudang/manajemen_pembelian', [DashboardController::class, 'manajemenPembelian'])->name('kepala_gudang.manajemen_pembelian');
    Route::get('kepala_gudang/stok_masuk/tambah', [StokMasukController::class, 'create'])->name('kepala_gudang.stok_masuk.create');
    Route::post('kepala_gudang/stok_masuk', [StokMasukController::class, 'store'])->name('kepala_gudang.stok_masuk.store');
    Route::get('kepala_gudang/stok_masuk/{pupuk}/edit', [StokMasukController::class, 'edit'])->name('kepala_gudang.stok_masuk.edit');
    Route::put('kepala_gudang/stok_masuk/{pupuk}', [StokMasukController::class, 'update'])->name('kepala_gudang.stok_masuk.update');
    Route::delete('kepala_gudang/stok_masuk/{pupuk}', [StokMasukController::class, 'destroy'])->name('kepala_gudang.stok_masuk.destroy');

    // STOK KELUAR
    Route::get('kepala_gudang/stok_keluar', [StokKeluarController::class, 'index'])->name('kepala_gudang.stok_keluar.index');
    Route::get('kepala_gudang/stok_keluar/tambah', [StokKeluarController::class, 'create'])->name('kepala_gudang.stok_keluar.create');
    Route::post('kepala_gudang/stok_keluar', [StokKeluarController::class, 'store'])->name('kepala_gudang.stok_keluar.store');
    Route::get('kepala_gudang/stok_keluar/{stokKeluar}/edit', [StokKeluarController::class, 'edit'])->name('kepala_gudang.stok_keluar.edit');
    Route::put('kepala_gudang/stok_keluar/{stokKeluar}', [StokKeluarController::class, 'update'])->name('kepala_gudang.stok_keluar.update');
    Route::get('kepala_gudang/profile_settings', [DashboardController::class, 'profileSettings'])->name('kepala_gudang.profile_settings');
    Route::patch('kepala_gudang/profile_update', [UserController::class, 'updateProfile'])->name('kepala_gudang.update_profile');
});
// Logout
Route::get('logout', [AuthController::class, 'logout']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
