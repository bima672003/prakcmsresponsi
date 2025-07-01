<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::with('pelanggan')->get();
        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        return view('kendaraan.create', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'merek' => 'required',
            'nomor_plat' => 'required',
            'tahun_pembuatan' => 'required|digits:4'
        ]);

        Kendaraan::create($request->all());
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan');
    }

    public function show(Kendaraan $kendaraan)
    {
        $kendaraan->load('pelanggan');
        return view('kendaraan.show', compact('kendaraan'));
    }

    public function edit(Kendaraan $kendaraan)
    {
        $pelanggans = Pelanggan::all();
        return view('kendaraan.edit', compact('kendaraan', 'pelanggans'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'merek' => 'required',
            'nomor_plat' => 'required',
            'tahun_pembuatan' => 'required|digits:4'
        ]);

        $kendaraan->update($request->all());
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus');
    }
}