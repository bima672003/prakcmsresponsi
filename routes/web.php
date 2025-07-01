<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\AntrianServisController;
use App\Http\Controllers\PekerjaanServisController;
use App\Http\Controllers\TransaksiServisController;
use App\Http\Controllers\DashboardController;
Route::resource('pelanggan', PelangganController::class);
// atau
Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
// Route Utama
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route Resources
Route::resource('karyawan', KaryawanController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('kendaraan', KendaraanController::class);
Route::resource('antrian-servis', AntrianServisController::class);

// Pekerjaan Servis dengan prefix antrian
Route::prefix('antrian-servis/{antrian_id}')->group(function () {
    Route::resource('pekerjaan-servis', PekerjaanServisController::class)->except(['show']);
});

// Transaksi Servis
Route::resource('transaksi-servis', TransaksiServisController::class)->except(['create', 'store']);
Route::prefix('antrian-servis/{antrian_id}')->group(function () {
    Route::get('transaksi-servis/create', [TransaksiServisController::class, 'create'])->name('transaksi-servis.create');
    Route::post('transaksi-servis', [TransaksiServisController::class, 'store'])->name('transaksi-servis.store');
});

// Route tambahan untuk data chart (opsional)
Route::get('/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chart-data');