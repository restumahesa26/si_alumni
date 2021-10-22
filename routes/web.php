<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TanyaJawabController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::put('/data-alumni/pindah-ke-mahasiswa/{id}/', [AlumniController::class, 'change_to_mahasiswa'])->name('data-mahasiswa.change-to-mahasiswa');
Route::post('/data-alumni/import-excel', [AlumniController::class, 'import'])->name('import-alumni-excel');
Route::resource('data-alumni', AlumniController::class);

Route::put('/data-mahasiswa/pindah-ke-alumni/{id}/', [MahasiswaController::class, 'change_to_alumni'])->name('data-alumni.change-to-alumni');
Route::post('/data-mahasiswa/import-excel', [MahasiswaController::class, 'import'])->name('import-mahasiswa-excel');
Route::resource('data-mahasiswa', MahasiswaController::class);

Route::resource('data-admin', AdminController::class);

Route::resource('loker', LokerController::class);

Route::resource('berita', BeritaController::class);

Route::resource('diskusi', DiskusiController::class);

Route::get('/profile/show', [ProfileController::class, 'edit'])->name('profile.edit');

Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/loker/{id}/tanya-jawab/', [TanyaJawabController::class, 'tanya_jawab_loker'])->name('tanya_jawab_loker');

Route::delete('/loker/{id}/tanya-jawab/hapus', [TanyaJawabController::class, 'hapus_tanya_jawab_loker'])->name('hapus_tanya_jawab_loker');

Route::post('/diskusi/{id}/tanya-jawab/', [TanyaJawabController::class, 'tanya_jawab_diskusi'])->name('tanya_jawab_diskusi');

Route::delete('/diskusi/{id}/tanya-jawab/hapus', [TanyaJawabController::class, 'hapus_tanya_jawab_diskusi'])->name('hapus_tanya_jawab_diskusi');

Route::post('/berita/{id}/komentar/', [TanyaJawabController::class, 'komentar_berita'])->name('komentar_berita');

Route::delete('/berita/{id}/komentar/hapus', [TanyaJawabController::class, 'hapus_komentar_berita'])->name('hapus_komentar_berita');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
