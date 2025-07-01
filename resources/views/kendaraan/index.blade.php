@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Kendaraan</h1>
    
    <a href="{{ route('kendaraan.create') }}" class="btn btn-primary mb-3">Tambah Kendaraan</a>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Merek</th>
                    <th>Nomor Plat</th>
                    <th>Tahun</th>
                    <th>Pemilik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kendaraans as $index => $kendaraan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kendaraan->merek }}</td>
                    <td>{{ $kendaraan->nomor_plat }}</td>
                    <td>{{ $kendaraan->tahun_pembuatan }}</td>
                    <td>{{ $kendaraan->pelanggan->nama }}</td>
                    <td>
                        <a href="{{ route('kendaraan.show', $kendaraan->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('kendaraan.edit', $kendaraan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kendaraan.destroy', $kendaraan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kendaraan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection