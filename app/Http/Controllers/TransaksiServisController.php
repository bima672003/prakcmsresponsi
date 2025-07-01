<?php

namespace App\Http\Controllers;

use App\Models\TransaksiServis;
use App\Models\AntrianServis;
use App\Models\PekerjaanServis;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class TransaksiServisController extends Controller
{
    public function create($antrian_id)
    {
        $antrian = AntrianServis::with('pekerjaanServis')->findOrFail($antrian_id);
        $kasirs = Karyawan::where('jabatan', 'kasir')->get();
        
        $totalBiaya = $antrian->pekerjaanServis->sum('biaya');
        
        return view('transaksi_servis.create', compact('antrian', 'kasirs', 'totalBiaya'));
    }

    public function store(Request $request, $antrian_id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'metode_pembayaran' => 'required|in:tunai,transfer,kredit'
        ]);

        $antrian = AntrianServis::with('pekerjaanServis')->findOrFail($antrian_id);
        $totalBiaya = $antrian->pekerjaanServis->sum('biaya');

TransaksiServis::create([
    'no_transaksi' => 'TRX-' . now()->format('YmdHis'),
    'tanggal' => now(),
    'antrian_servis_id' => $antrian->id,
    'total_biaya' => $totalBiaya, //  
    'karyawan_id' => $request->karyawan_id, // 
]);



        // Update status antrian menjadi selesai
        $antrian->update(['status' => 'selesai']);

        return redirect()->route('antrian-servis.index')
            ->with('success', 'Transaksi servis berhasil dibuat');
    }

    public function index()
{
    $transaksis = TransaksiServis::with(['antrianServis.kendaraan.pelanggan', 'karyawan'])->get();
    return view('transaksi_servis.index', compact('transaksis'));
}


    public function show(TransaksiServis $transaksiServis)
    {
        $transaksiServis->load([
            'antrianServis.kendaraan.pelanggan',
            'antrianServis.pekerjaanServis',
            'karyawan'
        ]);
        
        return view('transaksi_servis.show', compact('transaksiServis'));
    }
}