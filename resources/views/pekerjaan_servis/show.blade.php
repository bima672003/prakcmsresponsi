@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pekerjaan Servis</h1>
    
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Servis</h5>
        </div>
        <div class="card-body">
            <p><strong>Deskripsi:</strong> {{ $pekerjaanServis->deskripsi }}</p>
            <p><strong>Biaya:</strong> Rp {{ number_format($pekerjaanServis->biaya, 0, ',', '.') }}</p>
            <p><strong>Tanggal Dibuat:</strong> {{ $pekerjaanServis->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Antrian Servis</h5>
        </div>
        <div class="card-body">
            <p><strong>Status Antrian:</strong> 
                <span class="badge 
                    @if($pekerjaanServis->antrianServis->status == 'dalam antrian') bg-secondary
                    @elseif($pekerjaanServis->antrianServis->status == 'sedang diservis') bg-warning text-dark
                    @else bg-success @endif">
                    {{ ucfirst(str_replace('_', ' ', $pekerjaanServis->antrianServis->status)) }}
                </span>
            </p>
            <p><strong>Tanggal Masuk:</strong> {{ $pekerjaanServis->antrianServis->created_at->format('d/m/Y H:i') }}</p>
            @if($pekerjaanServis->antrianServis->karyawan)
                <p><strong>Mekanik:</strong> {{ $pekerjaanServis->antrianServis->karyawan->nama }}</p>
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Kendaraan</h5>
        </div>
        <div class="card-body">
            <p><strong>Pemilik:</strong> {{ $pekerjaanServis->antrianServis->kendaraan->pelanggan->nama }}</p>
            <p><strong>Merek/Tipe:</strong> {{ $pekerjaanServis->antrianServis->kendaraan->merk }}</p>
            <p><strong>Nomor Plat:</strong> {{ $pekerjaanServis->antrianServis->kendaraan->nomor_plat }}</p>
            <p><strong>Tahun:</strong> {{ $pekerjaanServis->antrianServis->kendaraan->tahun }}</p>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('pekerjaan-servis.index', $pekerjaanServis->antrian_servis_id) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
        <div>
            <a href="{{ route('pekerjaan-servis.edit', $pekerjaanServis->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
</div>
@endsection