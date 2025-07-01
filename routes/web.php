<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\AntrianServisController;
use App\Http\Controllers\PekerjaanServisController;
use App\Http\Controllers\TransaksiServisController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login'); // arahkan ke halaman login atau home
})->name('logout');
Route::prefix('antrian-servis/{antrian_id}/pekerjaan-servis')->group(function () {
    Route::get('/', [PekerjaanServisController::class, 'index'])->name('pekerjaan-servis.index');
    Route::get('/create', [PekerjaanServisController::class, 'create'])->name('pekerjaan-servis.create');
    Route::post('/', [PekerjaanServisController::class, 'store'])->name('pekerjaan-servis.store');
});

Route::get('/pekerjaan-servis/{pekerjaanServis}', [PekerjaanServisController::class, 'show'])->name('pekerjaan-servis.show');
Route::get('/pekerjaan-servis/{pekerjaanServis}/edit', [PekerjaanServisController::class, 'edit'])->name('pekerjaan-servis.edit');
Route::put('/pekerjaan-servis/{pekerjaanServis}', [PekerjaanServisController::class, 'update'])->name('pekerjaan-servis.update');
Route::delete('/pekerjaan-servis/{pekerjaanServis}', [PekerjaanServisController::class, 'destroy'])->name('pekerjaan-servis.destroy');
