<?php

use App\Http\Controllers\BalitaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\IbuBalitaController;
use App\Http\Controllers\IbuHamilController;
use App\Http\Controllers\IbuKBController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\JadwalKegiatanController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\KeuanganpmtController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenimbanganController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TimbangdanVitaminController;
use App\Models\Ortu;
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
    return view('layouts.landing_page');
});

// Authenticate
Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registrasion
Route::get('register', [RegisterController::class, 'index'])->name('register.index')->middleware('guest');
Route::post('register', [RegisterController::class, 'create'])->name('register.create');

Route::get('anak', [GetDataController::class, 'getBalita'])->name('anak.index')->middleware('guest');
Route::get('get_penimbangan/{id}', [GetDataController::class, 'getPenimbangan'])->middleware('guest');

// Middleware
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('balita', BalitaController::class)->except('update', 'destroy');
    Route::get('profile/{id}', [LoginController::class, 'profile'])->name('profile');
    Route::post('profile/update/{id}', [LoginController::class, 'profile_update']);
    Route::post('profile/ganti_password/{id}', [LoginController::class, 'ganti_password']);

    Route::middleware('is_ketua_and_kader')->group(function () {

        Route::get('penimbangan', [PenimbanganController::class, 'index'])->name('penimbangan.index');
        Route::get('get_nama_balita/{id}', [GetDataController::class, 'getNamaBalita']);
        Route::get('imunisasi', [ImunisasiController::class, 'index'])->name('imunisasi.index');

        // Route imunisasi
        Route::resource('imunisasi', ImunisasiController::class)->except('index', 'update', 'destroy');
        Route::post('imunisasi/{id}', [ImunisasiController::class, 'update']);
        Route::post('imunisasi/delete/{id}', [ImunisasiController::class, 'destroy'])->name('imunisasi.destroy');
        // Route::post('imunisasi/get_nama_balita', [ImunisasiController::class, 'getNamaBalita']);
        Route::post('get_nama_balita', [GetDataController::class, 'getNamaBalita'])->name('getNamaBalita');
        Route::get('get_nama_ortu/{id}', [GetDataController::class, 'getNamaOrtu'])->name('getNamaOrtu');
        Route::post('get_jenis_vaksin', [GetDataController::class, 'getJenisVaksin'])->name('getJenisVaksin');
        Route::get('export/imunisasi/{tahun}', [ImunisasiController::class, 'export'])->name('export.imunisasi');

        // Route pemberian vitamin
        Route::resource('pemberian_vitamin', TimbangdanVitaminController::class)->except('update', 'destroy');
        Route::post('pemberian_vitamin/{timbangdanVitamin}', [TimbangdanVitaminController::class, 'update']);
        Route::post('pemberian_vitamin/delete/{timbangdanVitamin}', [TimbangdanVitaminController::class, 'destroy']);
        Route::get('export/pemberian_vitamin/{bulan}&{tahun}', [TimbangdanVitaminController::class, 'export']);
        Route::post('penimbangan-dan-pemberian_vitamin/get_nama_balita', [GetDataController::class, 'getNamaBalitaPenimbangan'])->name('getNamaBalitaPenimbangan');
        Route::get('pemberian_vitamin/get_nama_ortu/{id}', [GetDataController::class, 'getNamaOrtu']);

        // Route penimbangan balita
        Route::resource('penimbangan', PenimbanganController::class)->except('index', 'update', 'destroy');
        Route::prefix('penimbangan')->group(function () {
            Route::post('/{penimbangan}', [PenimbanganController::class, 'update'])->name('penimbangan.update');
            Route::post('/delete/{penimbangan}', [PenimbanganController::class, 'destroy'])->name('penimbangan.destroy');
            Route::post('/delete/{penimbangan}', [PenimbanganController::class, 'destroyOne'])->name('penimbangan.destroyOne');
            Route::get('/get-data-edit/{id}', [PenimbanganController::class, 'getDataEdit'])->name('penimbangan.getDataEdit');
            Route::get('/export/{tahun}', [PenimbanganController::class, 'export'])->name('penimbangan.export.excel');
        });
    });

    // Middleware checkrole is ketua
    Route::middleware('checkrole:Ketua')->group(function () {
        // route kader
        Route::resource('kader', KaderController::class)->except('update', 'destroy');
        Route::post('kader/{kader}', [KaderController::class, 'update']);
        Route::post('kader/delete/{kader}', [KaderController::class, 'destroy']);

        // route verifikasi ibu balita
        Route::resource('ibu_balita', IbuBalitaController::class)->except('store', 'update', 'destroy');
        Route::post('ibu_balita/{ibuBalita}', [IbuBalitaController::class, 'update']);
        Route::post('ibu_balita/delete/{ibuBalita}', [IbuBalitaController::class, 'destroy']);

        // JADWAL KEGIATAN
        Route::resource('jadwal_kegiatan', JadwalKegiatanController::class)->except('update', 'destroy');
        Route::post('jadwal_kegiatan/{jadwalkegiatan}', [JadwalKegiatanController::class, 'update']);
        Route::post('jadwal_kegiatan/delete/{jadwalkegiatan}', [JadwalKegiatanController::class, 'destroy']);

        // KEUANGAN PMT
        Route::resource('keuangan_pmt', KeuanganpmtController::class)->except('update', 'destroy');
        Route::post('keuangan_pmt/{keuanganpmt}', [KeuanganpmtController::class, 'update']);
        Route::post('keuangan_pmt/delete/{keuanganpmt}', [KeuanganpmtController::class, 'destroy']);
    });

    // Middleware checkrole is kader
    Route::middleware('checkrole:Kader')->group(function () {
        // Route balita
        Route::post('balita/{balita}', [BalitaController::class, 'update']);
        Route::post('balita/delete/{balita}', [BalitaController::class, 'destroy']);
        Route::post('nama_ibu', [GetDataController::class, 'getNamaIbu'])->name('get_nama_ibu');
        Route::get('verifikasi-update-balita', [BalitaController::class, 'indexVerifikasiUpdateBalita'])->name('verifikasi_update_balita');
        Route::post('verifikasi-update-balita', [BalitaController::class, 'indexVerifikasiUpdateBalita'])->name('verifikasi_update_balita.index');
        Route::get('verifikasi-update-balita/edit/{id}', [BalitaController::class, 'editVerifikasiUpdateBalita'])->name('verifikasi_update_balita.edit');
        Route::post('verifikasi-update-balita/update/{id}', [BalitaController::class, 'updateVerifikasiUpdateBalita'])->name('verifikasi_update_balita.update');
        // Route::resource('ortu', Ortu::class);

        // Route ibu hamil
        Route::resource('ibu_hamil', IbuHamilController::class)->except('update', 'destroy');
        Route::post('ibu_hami/store-riwayat-pemeriksaan', [IbuHamilController::class, 'storeRiwayatIbuHamil'])->name('ibu_hamil.store.riwayat_pemeriksaan');
        Route::post('ibu_hamil/{ibuHamil}', [IbuHamilController::class, 'update'])->name('ibu_hamil.update');
        Route::post('ibu_hamil/delete/{ibuHamil}', [IbuHamilController::class, 'destroy']);
        Route::post('ibu_hamil/delete-riwayat-pemeriksaan/{id}', [IbuHamilController::class, 'destroyRiwayatIbuHamil'])->name('ibu_hamil.destroy.destroyRiwayatIbuHamil');
        Route::get('riwayat_ibu_hamil/{id}', [IbuHamilController::class, 'getRiwayatIbuHamil'])->name('ibu_hamil.getRiwayatIbuHamil');
        Route::get('export/ibu_hamil/{dari_tanggal}&{sampai_tanggal}', [IbuHamilController::class, 'export']);
        Route::post('get_ibu_hamil', [GetDataController::class, 'getIbuHamils']);

        // Route ibu kb
        Route::resource('ibu_kb', IbuKBController::class)->except('update', 'destroy');
        Route::post('ibu_kb/{ibuHamil}', [IbuKBController::class, 'update']);
        Route::post('ibu_kb/delete/{ibuHamil}', [IbuKBController::class, 'destroy']);
        Route::post('get_ibu_kb', [GetDataController::class, 'getIbuKbs']);
        Route::get('export/ibu_kb/{dari_tanggal}&{sampai_tanggal}', [IbuKBController::class, 'export']);
    });

    // Middleware checkrole is ibu balita
    Route::middleware('checkrole:Ibu Balita')->group(function () {
        Route::post('anak', [BalitaController::class, 'store']);
        Route::post('anak/{balita}', [BalitaController::class, 'update']);
    });
});
