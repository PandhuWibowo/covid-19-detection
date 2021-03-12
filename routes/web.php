<?php

use Illuminate\Support\Facades\Route;

/**
 * Sign In
 */
Route::get('/signin', function () {
    return view('front-layout.signin');
});

/**
 * Users
 */
Route::prefix('users')->group(function() {
    Route::get('/', function() {
        return view('admin-dashboard.users.index');
    });
});

/**
 * Warga
 */
Route::prefix('warga')->group(function() {
    Route::get('/', function() {
        return view('admin-dashboard.warga.index');
    });
});

/**
 * Peta
 */
Route::prefix('peta')->group(function() {
    Route::get('/cari-alamat', function() {
        return view('admin-dashboard.warga.index');
    });
});

/**
 * Peta - Tanpa Login
 */
Route::get('/cari-alamat', function() {
    return view('front-layout.cari-alamat');
});