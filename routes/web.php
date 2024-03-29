<?php

use App\Http\Controllers\BarangBuktiController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\HakimController;
use App\Http\Controllers\JenisPerkaraController;
use App\Http\Controllers\JenisPihakontroller;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PerkaraController;
use App\Http\Controllers\PihakController;
use App\Http\Controllers\PutusanController;
use App\Http\Controllers\SidangController;
use App\Http\Controllers\SuratDisposisiController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\UserController;
use App\Models\Divisi;
use App\Models\JenisSurat;
use App\Models\SuratDisposisi;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\DB;
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
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('divisi', [DivisiController::class, 'index'])->name('divisi');
    Route::post('tambah_divisi', [DivisiController::class, 'store'])->name('tambah_divisi');
    Route::get('hapus_divisi/{id}', [DivisiController::class, 'destroy'])->name('hapus_divisi');
    Route::post('edit_divisi', [DivisiController::class, 'update'])->name('edit_divisi');

    // pengadilan
    

    Route::controller(PutusanController::class)
        ->prefix('putusan')
        ->name('putusan.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::get('/{id}', 'destroy')->name('destroy');
        });
    Route::controller(BiayaController::class)
        ->prefix('biaya')
        ->name('biaya.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::get('/{id}', 'destroy')->name('destroy');
        });
    Route::controller(SidangController::class)
        ->prefix('sidang')
        ->name('sidang.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::get('/{id}', 'destroy')->name('destroy');
        });
    Route::controller(HakimController::class)
        ->prefix('hakim')
        ->name('hakim.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::get('/{id}', 'destroy')->name('destroy');
        });
    Route::controller(BarangBuktiController::class)
        ->prefix('barang_bukti')
        ->name('barang_bukti.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::get('/{id}', 'destroy')->name('destroy');
        });
    Route::controller(PerkaraController::class)
        ->prefix('perkara')
        ->name('perkara.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/detail/{id_perkara}', 'detail')->name('detail');
            Route::post('/', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::get('/{id}', 'destroy')->name('destroy');
        });

    Route::controller(LaporanController::class)
        ->prefix('lap_pengadilan')
        ->name('lap_pengadilan.')
        ->group(function () {
            Route::get('/perkara', 'perkara')->name('perkara');
            Route::get('/save_perkara', 'save_perkara')->name('save_perkara');

            Route::get('/pihak', 'pihak')->name('pihak');
            Route::get('/save_pihak', 'save_pihak')->name('save_pihak');

            Route::get('/barang_bukti', 'barang_bukti')->name('barang_bukti');
            Route::get('/save_barang_bukti', 'save_barang_bukti')->name('save_barang_bukti');

            Route::get('/sidang', 'sidang')->name('sidang');
            Route::get('/save_sidang', 'save_sidang')->name('save_sidang');

            Route::get('/hakim', 'hakim')->name('hakim');
            Route::get('/save_hakim', 'save_hakim')->name('save_hakim');

            Route::get('/biaya', 'biaya')->name('biaya');
            Route::get('/save_biaya', 'save_biaya')->name('save_biaya');


        });

    Route::controller(PihakController::class)
        ->prefix('pihak')
        ->name('pihak.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::get('/{id}', 'destroy')->name('destroy');
        });
    Route::controller(JenisPerkaraController::class)
        ->prefix('jenis_perkara')
        ->name('jenis_perkara.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::get('/{id}', 'destroy')->name('destroy');
        });
    Route::controller(JenisPihakontroller::class)
        ->prefix('jenis_pihak')
        ->name('jenis_pihak.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::get('/{id}', 'destroy')->name('destroy');
        });

    Route::get('surat_masuk', [SuratMasukController::class, 'index'])->name('surat_masuk');
    Route::post('tambah_surat_masuk', [SuratMasukController::class, 'store'])->name('tambah_surat_masuk');
    Route::post('edit_surat_masuk', [SuratMasukController::class, 'update'])->name('edit_surat_masuk');
    Route::get('hapus_surat_masuk/{id}', [SuratMasukController::class, 'destroy'])->name('hapus_surat_masuk');

    // disposisi
    Route::get('surat_disposisi', [SuratDisposisiController::class, 'index'])->name('surat_disposisi');
    Route::get('hapus_surat_disposisi/{id}/{id_sm}', [SuratDisposisiController::class, 'destroy'])->name('hapus_surat_disposisi');
    Route::get('detail_disposisi/{id}/{id_sm}', [SuratDisposisiController::class, 'detail'])->name('detail_disposisi');
    Route::post('tambahSuratDisposisi', [SuratDisposisiController::class, 'tambahSuratDisposisi'])->name('tambahSuratDisposisi');
    Route::post('edit_surat_disposisi', [SuratDisposisiController::class, 'update'])->name('edit_surat_disposisi');
    
    // jenis surat
    Route::get('jenis_surat', [JenisSuratController::class, 'index'])->name('jenis_surat');
    Route::get('/hapus_js/{id}', [JenisSuratController::class, 'destroy'])->name('hapus_js');
    Route::post('tambah_js', [JenisSuratController::class, 'tambah_js'])->name('tambah_js');
    Route::post('edit_js', [JenisSuratController::class, 'update'])->name('edit_js');
    
    Route::get('surat_keluar', [SuratKeluarController::class, 'index'])->name('surat_keluar');
    Route::post('tambah_surat_keluar', [SuratKeluarController::class, 'store'])->name('tambah_surat_keluar');
    Route::post('edit_surat_keluar', [SuratKeluarController::class, 'update'])->name('edit_surat_keluar');
    Route::get('hapus_surat_keluar/{id}', [SuratKeluarController::class, 'destroy'])->name('hapus_surat_keluar');
    
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::post('tambah_user', [UserController::class, 'create'])->name('tambah_user');
    Route::post('edit_user', [UserController::class, 'update'])->name('edit_user');
    Route::get('/hapus_user/{id}', [UserController::class, 'destroy'])->name('hapus_user');
    
    // laporan
    Route::get('lap_masuk/{jenis}', [LaporanController::class, 'suratMasuk'])->name('lap_masuk');
    Route::get('saveLapMasuk', [LaporanController::class, 'saveLapMasuk'])->name('saveLapMasuk');

    Route::get('lap_keluar/', [LaporanController::class, 'suratKeluar'])->name('lap_keluar');
    Route::get('saveLapKeluar', [LaporanController::class, 'saveLapKeluar'])->name('saveLapKeluar');

    Route::get('lap_jenis_surat/', [LaporanController::class, 'jenisSurat'])->name('lap_jenis_surat');
    Route::get('saveLapJenisSurat', [LaporanController::class, 'saveLapJenisSurat'])->name('saveLapJenisSurat');

    Route::get('lap_divisi/', [LaporanController::class, 'divisi'])->name('lap_divisi');
    Route::get('saveLapDivisi', [LaporanController::class, 'saveLapDivisi'])->name('saveLapDivisi');
});


Route::get('/dashboard', function () {
    $data = [
        'title' => 'Dashboard',
        'sm' => SuratMasuk::count(),
        'sp' => SuratDisposisi::count(),
        'sk' => SuratKeluar::count(),
        'js' => JenisSurat::count(),
        'dv' => Divisi::count(),
        'sd' => DB::table('tb_sidang')->count(),
        'pr' => DB::table('tb_perkara')->count(),
        'ph' => DB::table('tb_pihak')->count(),
    ];
    return view('dashboard.dashboard', $data);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
