@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pelanggan</h1>
    
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Pelanggan</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $pelanggan->nama }}</p>
            <p><strong>Alamat:</strong> {{ $pelanggan->alamat }}</p>
            <p><strong>No. Telepon:</strong> {{ $pelanggan->no_telepon }}</p>
            <p><strong>Tanggal Registrasi:</strong> {{ $pelanggan->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Kendaraan</h5>
        </div>
        <div class="card-body">
            @if($pelanggan->kendaraans->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Merek</th>
                                <th>Nomor Plat</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelanggan->kendaraans as $kendaraan)
                            <tr>
                                <td>{{ $kendaraan->merk }}</td>
                                <td>{{ $kendaraan->nomor_plat }}</td>
                                <td>{{ $kendaraan->tahun }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Belum ada kendaraan terdaftar</p>
            @endif
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
</div>
@endsection