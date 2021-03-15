<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\UserController;

/**
 * Sign In
 */
Route::middleware(['AuthCheck'])->get('/signin', function () {
    return view('front-layout.signin');
});
Route::post('auth/process', [SignInController::class, 'auth'])->name('auth');
Route::get('auth/signout', [SignInController::class, 'signout'])->name('signout');

/**
 * Dashboard
 */
Route::middleware(['AuthCheck'])->get('dashboard', [SignInController::class, 'dashboard']);

/**
 * Users
 */
Route::middleware(['AuthCheck'])->prefix('users')->group(function() {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'createUser']);
});

/**
 * Warga
 */
Route::middleware(['AuthCheck'])->prefix('warga')->group(function() {
    Route::get('/', function() {
        return view('admin-dashboard.warga.index');
    });
});

/**
 * Covid Tracer
 */
// Route::prefix('suspects')->group(function() {
//     Route::get('/', );
// });