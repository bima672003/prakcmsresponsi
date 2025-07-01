@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Kendaraan</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informasi Kendaraan</h5>
            <p class="card-text">
                <strong>Merek:</strong> {{ $kendaraan->merek }}<br>
                <strong>Nomor Plat:</strong> {{ $kendaraan->nomor_plat }}<br>
                <strong>Tahun Pembuatan:</strong> {{ $kendaraan->tahun_pembuatan }}<br>
            </p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Informasi Pemilik</h5>
            <p class="card-text">
                <strong>Nama:</strong> {{ $kendaraan->pelanggan->nama }}<br>
                <strong>No. Telepon:</strong> {{ $kendaraan->pelanggan->no_telepon }}<br>
                <strong>Alamat:</strong> {{ $kendaraan->pelanggan->alamat }}<br>
            </p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('kendaraan.edit', $kendaraan->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection