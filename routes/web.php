<?php

use App\Http\Controllers\BalitaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\IbuBalitaController;
use App\Http\Controllers\IbuHamilController;
use App\Http\Controllers\IbuKBController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenimbanganController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TimbangdanVitaminController;
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

// Authenticate
Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registrasion
Route::get('register', [RegisterController::class, 'index'])->name('register.index')->middleware('guest');
Route::post('register', [RegisterController::class, 'create'])->name('register.create');

// Middleware
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('get_nama_balita/{id}', [GetDataController::class, 'get_nama_balita']);
    Route::get('profile/{id}', [LoginController::class, 'profile'])->name('profile');
    Route::post('profile/{id}', [LoginController::class, 'profile_update']);
    // Route::post('profile/ganti_password/{id}', [LoginController::class, 'ganti_password']);

    // Middleware checkrole is ketua
    Route::middleware('checkrole:Ketua')->group(function () {
        // route kader
        Route::resource('kader', KaderController::class)->except('update', 'destroy');
        Route::post('kader/{kader}', [KaderController::class, 'update']);
        Route::post('kader/delete/{kader}', [KaderController::class, 'destroy']);

        // route verifikasi ibu balita
        Route::resource('ibu_balita', IbuBalitaController::class)->except('update', 'destroy');
        Route::post('ibu_balita/{ibuBalita}', [IbuBalitaController::class, 'update']);
        Route::post('ibu_balita/delete/{ibuBalita}', [IbuBalitaController::class, 'destroy']);
    });

    // Middleware checkrole is kader
    Route::middleware('checkrole:Kader')->group(function () {
        // Route balita
        Route::resource('balita', BalitaController::class)->except('update', 'destroy');
        Route::post('balita/{balita}', [BalitaController::class, 'update']);
        Route::post('balita/delete/{balita}', [BalitaController::class, 'destroy']);
        Route::post('nama_ayah', [GetDataController::class, 'getNamaAyah'])->name('get_nama_ayah');

        // Route imunisasi
        Route::resource('imunisasi', ImunisasiController::class)->except('update', 'destroy');
        Route::post('imunisasi/{imunisasi}', [ImunisasiController::class, 'update']);
        Route::post('imunisasi/delete/{imunisasi}', [ImunisasiController::class, 'destroy']);
        Route::post('imunisasi/get_nama_balita', [ImunisasiController::class, 'getNamaBalita']);
        Route::get('imunisasi/get_nama_ortu/{imunisasi}', [ImunisasiController::class, 'getNamaOrtu']);

        // Route pemberian vitamin
        Route::resource('pemberian_vitamin', TimbangdanVitaminController::class)->except('update', 'destroy');
        Route::post('pemberian_vitamin/{timbangdanVitamin}', [TimbangdanVitaminController::class, 'update']);
        Route::post('pemberian_vitamin/delete/{timbangdanVitamin}', [TimbangdanVitaminController::class, 'destroy']);

        // Route penimbangan balita
        Route::resource('penimbangan', PenimbanganController::class)->except('update', 'destroy');
        Route::post('penimbangan/{penimbangan}', [PenimbanganController::class, 'update']);
        Route::post('penimbangan/delete/{penimbangan}', [PenimbanganController::class, 'destroy']);

        // Route ibu hamil
        Route::resource('ibu_hamil', IbuHamilController::class)->except('update', 'destroy');
        Route::post('ibu_hamil/{ibuHamil}', [IbuHamilController::class, 'update']);
        Route::post('ibu_hamil/delete/{ibuHamil}', [IbuHamilController::class, 'destroy']);
        Route::post('get_ibu_hamil', [GetDataController::class, 'getIbuHamils']);

        // Route ibu kb
        Route::resource('ibu_kb', IbuKBController::class)->except('update', 'destroy');
        Route::post('ibu_kb/{ibuHamil}', [IbuKBController::class, 'update']);
        Route::post('ibu_kb/delete/{ibuHamil}', [IbuKBController::class, 'destroy']);
        Route::post('get_ibu_kb', [GetDataController::class, 'getIbuKbs']);
    });

    // Middleware checkrole is ortu
    Route::middleware('checkrole:Ibu Balita')->group(function () {
        Route::get('anak', [BalitaController::class, 'getBalita']);
        Route::get('get_penimbangan/{id}', [GetDataController::class, 'getPenimbangan']);
    });
});
