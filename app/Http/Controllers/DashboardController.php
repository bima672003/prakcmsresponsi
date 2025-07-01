<?php

namespace App\Http\Controllers;

use App\Models\AntrianServis;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use App\Models\Karyawan;
use App\Models\TransaksiServis;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik penting untuk dashboard
        $totalPelanggan = Pelanggan::count();
        $totalKendaraan = Kendaraan::count();
        $totalMekanik = Karyawan::where('jabatan', 'mekanik')->count();
        
        // Ambil data antrian servis
        $antrianBerjalan = AntrianServis::with(['kendaraan', 'pelanggan', 'karyawan'])
            ->whereIn('status', ['dalam antrian', 'sedang diservis'])
            ->orderBy('created_at', 'asc')
            ->get();
            
        // Ambil data transaksi terakhir
        $transaksiTerakhir = TransaksiServis::with(['antrianServis.kendaraan', 'karyawan'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Hitung pendapatan hari ini
        $pendapatanHariIni = TransaksiServis::whereDate('created_at', today())
            ->sum('total_biaya');
            
        // Hitung servis selesai hari ini
        $servisSelesaiHariIni = AntrianServis::where('status', 'selesai')
            ->whereDate('updated_at', today())
            ->count();

        return view('home', compact(
            'totalPelanggan',
            'totalKendaraan',
            'totalMekanik',
            'antrianBerjalan',
            'transaksiTerakhir',
            'pendapatanHariIni',
            'servisSelesaiHariIni'
        ));
    }
}