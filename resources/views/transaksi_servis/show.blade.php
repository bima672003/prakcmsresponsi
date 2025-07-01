@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Transaksi Servis</h1>
    
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Transaksi</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>No. Transaksi:</strong> TRX-{{ str_pad($transaksiServis->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <p><strong>Tanggal:</strong> {{ $transaksiServis->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Kasir:</strong> {{ $transaksiServis->karyawan->nama }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total Biaya:</strong> Rp {{ number_format($transaksiServis->total_biaya, 0, ',', '.') }}</p>
                    <p><strong>Metode Pembayaran:</strong> {{ ucfirst($transaksiServis->metode_pembayaran) }}</p>
                    <p><strong>Status:</strong> <span class="badge bg-success">Selesai</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Servis</h5>
        </div>
        <div class="card-body">
            <p><strong>No. Antrian:</strong> {{ $transaksiServis->antrianServis->id }}</p>
            <p><strong>Tanggal Masuk:</strong> {{ $transaksiServis->antrianServis->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Mekanik:</strong> {{ $transaksiServis->antrianServis->karyawan ? $transaksiServis->antrianServis->karyawan->nama : '-' }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detail Pekerjaan Servis</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Deskripsi</th>
                            <th>Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksiServis->antrianServis->pekerjaanServis as $pekerjaan)
                        <tr>
                            <td>{{ $pekerjaan->deskripsi }}</td>
                            <td>Rp {{ number_format($pekerjaan->biaya, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        <tr class="table-active">
                            <td><strong>Total</strong></td>
                            <td><strong>Rp {{ number_format($transaksiServis->total_biaya, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Kendaraan</h5>
        </div>
        <div class="card-body">
            <p><strong>Pelanggan:</strong> {{ $transaksiServis->antrianServis->kendaraan->pelanggan->nama }}</p>
            <p><strong>Merek/Tipe:</strong> {{ $transaksiServis->antrianServis->kendaraan->merk }}</p>
            <p><strong>Nomor Plat:</strong> {{ $transaksiServis->antrianServis->kendaraan->nomor_plat }}</p>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('transaksi-servis.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection
