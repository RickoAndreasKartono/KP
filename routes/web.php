<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return view('landing');
});



Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::view('/login', 'login')->name('login');
Route::get('/reset_password', [ResetPasswordController::class, 'showResetForm'])->name('password.request');
Route::post('/password/update', [ResetPasswordController::class, 'updatePassword'])->name('password.update');


Route::get('/dashboard', function () {
    return view('dashboard'); // Tampilkan halaman dashboard
})->name('dashboard')->middleware('auth');

Route::get('/home', function () {
    return view('home.index');
});

Route::get('/laporan-stok', [StokController::class, 'laporan'])->name('laporan.stok');


Route::get('/check-db', function () {
    return DB::connection()->getDatabaseName();
});


