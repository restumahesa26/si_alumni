<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
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

Route::middleware(['auth'])
    ->group(function() {
        Route::post('/diskusi/detail/{id}/kirim-jawaban', [HomeController::class, 'kirim_jawaban_diskusi'])->name('user.kirim-jawaban-diskusi');

        Route::delete('/diskusi/detail/{id}/hapus-jawaban', [HomeController::class, 'hapus_jawaban_diskusi'])->name('user.hapus-jawaban-diskusi');

        Route::get('/diskusi-saya', [HomeController::class, 'diskusi_saya'])->name('user.diskusi-saya');

        Route::get('/diskusi/ajukan-diskusi', [HomeController::class, 'ajukan_diskusi'])->name('user.ajukan-diskusi');

        Route::post('/diskusi/ajukan-diskusi/store', [HomeController::class, 'ajukan_diskusi_store'])->name('user.ajukan-diskusi-store');

        Route::get('/data-saya', [HomeController::class, 'data_saya'])->name('user.data-saya');

        Route::get('/daftar-alumni', [HomeController::class, 'daftar_alumni'])->name('daftar-alumni');

        Route::get('/daftar-alumni/detail/{id}', [HomeController::class, 'detail_alumni'])->name('detail-alumni');

        Route::post('/berita/kirim-komentar/store/{id}', [HomeController::class, 'store_komentar'])->name('user.komentar-store');

        Route::delete('/berita/hapus-komentar/delete/{id}', [HomeController::class, 'delete_komentar'])->name('user.komentar-delete');

        Route::post('/lowongan-kerja/kirim-tanya-jawab/store/{id}', [HomeController::class, 'store_tanya_jawab_loker'])->name('user.tanya-jawab-loker');

        Route::delete('/lowongan-kerja/kirim-tanya-jawab/delete/{id}', [HomeController::class, 'delete_tanya_jawab_loker'])->name('user.tanya-jawab-loker-hapus');

        Route::post('/data-saya/update-akun', [ProfileController::class, 'update_akun'])->name('user.data-saya-update-akun');

        Route::post('/data-saya/update-data-pribadi', [ProfileController::class, 'data_pribadi'])->name('user.data-saya-data-pribadi');

        Route::post('/data-saya/update-data-orang-tua', [ProfileController::class, 'data_orang_tua'])->name('user.data-saya-data-orang-tua');

        Route::post('/data-saya/update-data-skripsi', [ProfileController::class, 'data_skripsi'])->name('user.data-saya-data-skripsi');
    });

Route::middleware(['auth','alumni'])
    ->group(function() {
        Route::get('/user/loker/ajukan-loker', [HomeController::class, 'ajukan_loker'])->name('user.ajukan-loker');

        Route::post('/user/loker/ajukan-loker/store', [HomeController::class, 'ajukan_loker_store'])->name('user.ajukan-loker-store');
    });

Route::prefix('admin')
    ->middleware(['auth','admin'])
    ->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::put('/data-alumni/pindah-ke-mahasiswa/{id}/', [AlumniController::class, 'change_to_mahasiswa'])->name('data-mahasiswa.change-to-mahasiswa');

        Route::post('/data-alumni/import-excel', [AlumniController::class, 'import'])->name('import-alumni-excel');
        Route::resource('data-alumni', AlumniController::class);

        Route::put('/data-mahasiswa/pindah-ke-alumni/{id}/', [MahasiswaController::class, 'change_to_alumni'])->name('data-alumni.change-to-alumni');

        Route::post('/data-mahasiswa/import-excel', [MahasiswaController::class, 'import'])->name('import-mahasiswa-excel');

        Route::resource('data-mahasiswa', MahasiswaController::class);

        Route::resource('data-admin', AdminController::class);

        Route::get('/loker/set-aktif/{id}', [LokerController::class, 'set_aktif'])->name('loker.set-aktif');

        Route::get('/loker/set-non-aktif/{id}', [LokerController::class, 'set_non_aktif'])->name('loker.set-non-aktif');

        Route::get('/diskusi/set-aktif/{id}', [DiskusiController::class, 'set_aktif'])->name('diskusi.set-aktif');

        Route::get('/diskusi/set-non-aktif/{id}', [DiskusiController::class, 'set_non_aktif'])->name('diskusi.set-non-aktif');

        Route::get('/berita/set-populer/{id}', [BeritaController::class, 'set_populer'])->name('berita.set-populer');

        Route::get('/berita/set-non-populer/{id}', [BeritaController::class, 'set_non_populer'])->name('berita.set-not-populer');

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

        Route::get('/laporan/mahasiswa', [LaporanController::class, 'index_mahasiswa'])->name('laporan.index-mahasiswa');

        Route::get('/laporan/alumni', [LaporanController::class, 'index_alumni'])->name('laporan.index-alumni');

        Route::get('/laporan/mahasiswa/cetak', [LaporanController::class, 'pdf_mahasiswa'])->name('laporan.pdf-mahasiswa');

        Route::get('/laporan/alumni/cetak/keseluruhan', [LaporanController::class, 'pdf_keseluruhan_alumni'])->name('laporan.pdf-keseluruhan-alumni');

        Route::get('/laporan/alumni/cetak/angkatan', [LaporanController::class, 'pdf_angkatan_alumni'])->name('laporan.pdf-angkatan-alumni');

        Route::get('/laporan/alumni/cetak/tahun-lulus', [LaporanController::class, 'pdf_tahun_lulus_alumni'])->name('laporan.pdf-tahun-lulus-alumni');
    });

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/berita', [HomeController::class, 'berita'])->name('user.berita');

Route::get('/berita/detail/{id}', [HomeController::class, 'detail_berita'])->name('user.detail-berita');

Route::get('/loker/pencarian/', [HomeController::class, 'search_berita'])->name('user.search-berita');

Route::get('/loker', [HomeController::class, 'loker'])->name('user.loker');

Route::get('/loker/detail/{id}', [HomeController::class, 'detail_loker'])->name('user.detail-loker');

Route::get('/loker/pencarian/berdasarkan-{tipe}/', [HomeController::class, 'search_loker'])->name('user.search-loker');

Route::get('/diskusi', [HomeController::class, 'diskusi'])->name('user.diskusi');

Route::get('/diskusi/detail/{id}', [HomeController::class, 'detail_diskusi'])->name('user.detail-diskusi');

Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

require __DIR__.'/auth.php';
