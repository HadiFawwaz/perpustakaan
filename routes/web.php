<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanController;

// =======================
// 🌐 HALAMAN UTAMA
// =======================
Route::get('/', function () {
    return view('welcome');
});

// =======================
// 🏠 DASHBOARD UMUM (setelah login)
// =======================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// =======================
// 📚 ADMIN / JAGA AREA
// =======================
Route::middleware(['auth', 'role:jaga'])->group(function () {

    // Dashboard Admin
    Route::get('/jaga', [BukuController::class, 'index'])->name('admin.dashboard');

    // CRUD Buku
    Route::resource('/jaga/buku', BukuController::class)->except(['show']);

    // Daftar Peminjaman


    // Detail Peminjaman
    Route::get('/jaga/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('admin.peminjaman.show');

    // Update Status Peminjaman
    Route::post('/jaga/peminjaman/{id}/status', [PeminjamanController::class, 'updateStatus'])->name('admin.peminjaman.status');
});
Route::get('/jaga/peminjaman', [PeminjamanController::class, 'index'])->name('admin.peminjaman.index');
// =======================
// 🎓 SISWA AREA
// =======================
Route::middleware(['auth', 'role:siswa'])->group(function () {

    // Dashboard siswa → daftar buku
    Route::get('/siswa', [BukuController::class, 'listForStudent'])->name('siswa.dashboard');

    // Detail Buku
    Route::get('/siswa/buku/{id}', [BukuController::class, 'show'])->name('siswa.buku.show');

    // Form Peminjaman Buku
    Route::get('/siswa/pinjam/{id}', [PeminjamanController::class, 'create'])->name('siswa.pinjam.create');
    Route::post('/siswa/pinjam', [PeminjamanController::class, 'store'])->name('siswa.pinjam.store');

    // Detail Peminjaman Siswa (opsional, jika mau siswa bisa lihat detail pinjamannya)
    Route::get('/siswa/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('siswa.peminjaman.show');
});

// =======================
// 👤 PROFIL USER
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
