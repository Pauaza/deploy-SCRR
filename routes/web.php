<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\admin\ManajemenDosenController;
use App\Http\Controllers\admin\ManajemenMhsController;
use App\Http\Controllers\AI\TitleGeneratorController;
use App\Http\Controllers\admin\DashboardController;


// Perbaikan Typo: Route::get (bukan Route: :get)
Route::get('/', function () {
    return view('auth.login');
});

// --- Login Routes ---
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- Protected Routes (Hanya bisa diakses jika sudah login) ---
Route::middleware('auth:mahasiswa,admin')->group(function () {

    // ================= MAHASISWA =================
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/dashboard', function () {
            return view('mahasiswa.dashboard');
        })->name('mahasiswa.dashboard');

        Route::get('/profile', [MahasiswaController::class, 'profile'])
            ->name('mahasiswa.profile');

        Route::post('/hasil-rekomendasi', [MahasiswaController::class, 'hasil'])
            ->name('mahasiswa.hasil_rekomendasi');

        Route::get('/rekomendasi', [MahasiswaController::class, 'rekomendasi'])
            ->name('mahasiswa.rekomendasi');

        // DETAIL DOSEN
        Route::get('/dosen/{id}', [MahasiswaController::class, 'detailDosen'])
            ->name('mahasiswa.detail_dosen');

        // DETAIL HISTORY
        Route::get('/mahasiswa/history/{id}', [MahasiswaController::class, 'detailHistory'])
            ->name('mahasiswa.history.show');
    });

    // ================= ADMIN =================
    Route::prefix('admin')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::resource('/manajemen-dosen', ManajemenDosenController::class)
            ->names('admin.manajemen_dosen');

        Route::resource('manajemen-mahasiswa', ManajemenMhsController::class)
            ->names('admin.manajemen_mahasiswa');

        Route::get('/profil', function () {
            return view('admin.profil');
        })->name('admin.profil');

        // ================= DOSEN PENELITIAN =================

        Route::get(
            '/manajemen-dosen/{id}/penelitian',
            [ManajemenDosenController::class, 'editPenelitian']
        )->name('admin.manajemen_dosen.penelitian');

        Route::post(
            '/manajemen-dosen/{id}/penelitian',
            [ManajemenDosenController::class, 'storePenelitian']
        )->name('admin.manajemen_dosen.penelitian.store');

        Route::delete(
            '/manajemen-dosen/penelitian/{id_penelitian}',
            [ManajemenDosenController::class, 'destroyPenelitian']
        )->name('admin.manajemen_dosen.penelitian.destroy');


        // ================= DOSEN SKRIPSI =================

        Route::get(
            '/manajemen-dosen/{id}/skripsi',
            [ManajemenDosenController::class, 'editSkripsi']
        )->name('admin.manajemen_dosen.skripsi');

        Route::post(
            '/manajemen-dosen/{id}/skripsi',
            [ManajemenDosenController::class, 'storeSkripsi']
        )->name('admin.manajemen_dosen.skripsi.store');

        Route::delete(
            '/manajemen-dosen/skripsi/{id_skripsi}',
            [ManajemenDosenController::class, 'destroySkripsi']
        )->name('admin.manajemen_dosen.skripsi.destroy');
    });

    // ================= AI Routes =================
    Route::get('/generate-judul', [TitleGeneratorController::class, 'index'])->name('judul.index');
    Route::post('/generate-judul', [TitleGeneratorController::class, 'generate'])->name('judul.generate');
});
