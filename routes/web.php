<?php

use Illuminate\Support\Facades\Route;

Route::get('/landing', function () {
    return view('landing');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/home', function () {
    return view('home.index');
});

Route::get('/check-db', function () {
    return DB::connection()->getDatabaseName();
});


