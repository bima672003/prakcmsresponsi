<?php

namespace App\Http\Controllers;

use App\Models\PekerjaanServis;
use App\Models\AntrianServis;
use Illuminate\Http\Request;

class PekerjaanServisController extends Controller
{
    public function index($antrian_id)
    {
        $antrian = AntrianServis::with(['pekerjaanServis', 'kendaraan.pelanggan'])->findOrFail($antrian_id);
        return view('pekerjaan_servis.index', compact('antrian'));
    }

    public function create($antrian_id)
    {
        $antrian = AntrianServis::findOrFail($antrian_id);
        return view('pekerjaan_servis.create', compact('antrian'));
    }

    public function store(Request $request, $antrian_id)
    {
        $request->validate([
            'deskripsi' => 'required',
            'biaya' => 'required|numeric'
        ]);

        PekerjaanServis::create([
            'antrian_servis_id' => $antrian_id,
            'deskripsi' => $request->deskripsi,
            'biaya' => $request->biaya
        ]);

        return redirect()->route('pekerjaan-servis.index', $antrian_id)
            ->with('success', 'Pekerjaan servis berhasil ditambahkan');
    }

    public function show(PekerjaanServis $pekerjaanServis)
    {
        $pekerjaanServis->load(['antrianServis.kendaraan.pelanggan', 'antrianServis.karyawan']);
        return view('pekerjaan_servis.show', compact('pekerjaanServis'));
    }

    public function edit(PekerjaanServis $pekerjaanServis)
    {
        return view('pekerjaan_servis.edit', compact('pekerjaanServis'));
    }

    public function update(Request $request, PekerjaanServis $pekerjaanServis)
    {
        $request->validate([
            'deskripsi' => 'required',
            'biaya' => 'required|numeric'
        ]);

        $pekerjaanServis->update($request->all());
        return redirect()->route('pekerjaan-servis.index', $pekerjaanServis->antrian_servis_id)
            ->with('success', 'Pekerjaan servis berhasil diperbarui');
    }

    public function destroy(PekerjaanServis $pekerjaanServis)
    {
        $antrian_id = $pekerjaanServis->antrian_servis_id;
        $pekerjaanServis->delete();
        return redirect()->route('pekerjaan-servis.index', $antrian_id)
            ->with('success', 'Pekerjaan servis berhasil dihapus');
    }
}