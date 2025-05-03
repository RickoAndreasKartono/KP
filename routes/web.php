<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('landing');
});



Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard'); // Tampilkan halaman dashboard
})->name('dashboard')->middleware('auth');

Route::get('/home', function () {
    return view('home.index');
});

Route::get('/check-db', function () {
    return DB::connection()->getDatabaseName();
});


