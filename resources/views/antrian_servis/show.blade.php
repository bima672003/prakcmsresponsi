@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Antrian Servis</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informasi Antrian</h5>
            <p class="card-text">
                <strong>Status:</strong> 
                <span class="badge 
                    @if($antrianServis->status == 'dalam antrian') bg-secondary
                    @elseif($antrianServis->status == 'sedang diservis') bg-warning text-dark
                    @else bg-success @endif">
                    {{ ucfirst(str_replace('_', ' ', $antrianServis->status)) }}
                </span><br>
                <strong>Tanggal Masuk:</strong> {{ $antrianServis->created_at->format('d/m/Y H:i') }}<br>
                @if($antrianServis->karyawan)
                    <strong>Mekanik:</strong> {{ $antrianServis->karyawan->nama }}<br>
                @endif
            </p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Informasi Kendaraan</h5>
            <p class="card-text">
                <strong>Merk/Tipe:</strong> {{ $antrianServis->kendaraan->merk }} {{ $antrianServis->kendaraan->tipe }}<br>
                <strong>Nomor Plat:</strong> {{ $antrianServis->kendaraan->nomor_plat }}<br>
                <strong>Tahun:</strong> {{ $antrianServis->kendaraan->tahun }}<br>
            </p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Informasi Pelanggan</h5>
            <p class="card-text">
                <strong>Nama:</strong> {{ $antrianServis->pelanggan->nama }}<br>
                <strong>No. Telepon:</strong> {{ $antrianServis->pelanggan->no_telepon }}<br>
                <strong>Alamat:</strong> {{ $antrianServis->pelanggan->alamat }}<br>
            </p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('antrian-servis.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('antrian-servis.edit', $antrianServis->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection