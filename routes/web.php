<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;

Route::get('/', function() {
    return redirect('signin');
});

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
    Route::put('/{id_user}', [UserController::class, 'updateUser']);
    Route::delete('/{id_user}', [UserController::class, 'deleteUser']);
});

/**
 * Warga
 */
Route::middleware(['AuthCheck'])->prefix('warga')->group(function() {
    Route::get('/', [WargaController::class, 'index']);
    Route::get('tambah-warga', [WargaController::class, 'addCitizen']);
    Route::post('/', [WargaController::class, 'createWarga']);
    Route::put('/{id_kk}/status-tempat-tinggal', [WargaController::class, 'updateStatusTempatTinggal']);
});

/**
 * Covid Tracer
 */
// Route::prefix('suspects')->group(function() {
//     Route::get('/', );
// });