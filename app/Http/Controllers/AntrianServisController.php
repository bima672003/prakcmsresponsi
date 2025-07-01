<?php

namespace App\Http\Controllers;

use App\Models\AntrianServis;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class AntrianServisController extends Controller
{
public function index()
{
    $antrians = AntrianServis::with(['kendaraan', 'pelanggan', 'karyawan'])->get();
    $kendaraans = Kendaraan::with('pelanggan')->get(); // Tambahkan ini
    return view('antrian_servis.index', compact('antrians', 'kendaraans')); // Tambahkan $kendaraans
}

    public function create()
    {
        $kendaraans = Kendaraan::with('pelanggan')->get();
        $mekaniks = Karyawan::where('jabatan', 'mekanik')->get();
        return view('antrian_servis.create', compact('kendaraans', 'mekaniks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'karyawan_id' => 'nullable|exists:karyawans,id'
        ]);

        $kendaraan = Kendaraan::find($request->kendaraan_id);
        
        $antrian = AntrianServis::create([
    'kendaraan_id' => $request->kendaraan_id,
    'pelanggan_id' => $kendaraan->pelanggan_id,
    'karyawan_id' => $request->karyawan_id,
    'waktu_daftar' => now(), // <-- tambahkan ini
]);


        return redirect()->route('antrian-servis.index')->with('success', 'Antrian servis berhasil ditambahkan');
    }

    public function show(AntrianServis $antrianServis)
    {
        $antrianServis->load(['kendaraan', 'pelanggan', 'karyawan']);
        return view('antrian_servis.show', compact('antrianServis'));
    }

    public function edit(AntrianServis $antrianServis)
    {
        $mekaniks = Karyawan::where('jabatan', 'mekanik')->get();
        return view('antrian_servis.edit', compact('antrianServis', 'mekaniks'));
    }

    public function update(Request $request, AntrianServis $antrianServis)
    {
        $request->validate([
            'karyawan_id' => 'nullable|exists:karyawans,id',
            'status' => 'required|in:dalam antrian,sedang diservis,selesai'
        ]);

        $antrianServis->update($request->all());
        return redirect()->route('antrian-servis.index')->with('success', 'Antrian servis berhasil diperbarui');
    }

    public function destroy(AntrianServis $antrianServis)
    {
        $antrianServis->delete();
        return redirect()->route('antrian-servis.index')->with('success', 'Antrian servis berhasil dihapus');
    }
}