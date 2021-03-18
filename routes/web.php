<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PasienController;

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
    Route::get('kartu-keluarga/{id_kk}', [WargaController::class, 'getKartuKeluarga']);
    Route::get('kartu-keluarga/{id_kk}/tambah-anggota-keluarga', [WargaController::class, 'addAnggotaKeluarga']);
    Route::post('kartu-keluarga/tambah-anggota-keluarga', [WargaController::class, 'createAnggotaKeluarga']);
    Route::get('kartu-keluarga/{id_kk}/ubah-anggota-keluarga/{nik}', [WargaController::class, 'editAnggotaKeluarga']);
    Route::put('kartu-keluarga/{id_kk}/ubah-anggota-keluarga/{nik}', [WargaController::class, 'updateAnggotaKeluarga']);
});

/**
 * Covid Tracer
 */
Route::prefix('pasien-covid')->group(function() {
    Route::get('/', [PasienController::class, 'index']);
    Route::get('/tambah-pasien', [PasienController::class, 'tambahPasien']);
    Route::post('/simpan-pasien-covid', [PasienController::class, 'simpanPasienCovid']);
    Route::put('/ubah-status-covid/{id_pendataan}', [PasienController::class, 'ubahStatusCovid']);
});