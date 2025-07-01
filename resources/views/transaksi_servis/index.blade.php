@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Transaksi Servis</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
    <tr>
        <th>#</th>
        <th>No. Transaksi</th>
        <th>Tanggal</th>
        <th>No. Antrian</th>
        <th>Pelanggan</th>
        <th>Total Biaya</th>
        <th>Kasir</th>
        <th>Aksi</th>
    </tr>
</thead>

<tbody>
    @foreach ($transaksis as $key => $transaksi)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $transaksi->no_transaksi }}</td>
        <td>{{ $transaksi->tanggal }}</td>
        <td>{{ $transaksi->antrianServis->id ?? '-' }}</td>
        <td>{{ $transaksi->antrianServis->kendaraan->pelanggan->nama ?? '-' }}</td>
        <td>Rp{{ number_format($transaksi->total_biaya, 0, ',', '.') }}</td>
        <td>{{ $transaksi->karyawan->nama ?? '-' }}</td>
        <td>
            <a href="{{ route('transaksi-servis.show', $transaksi->id) }}" class="btn btn-sm btn-info">Detail</a>
        </td>
    </tr>
    @endforeach
</tbody>

        </table>
    </div>
</div>
@endsection