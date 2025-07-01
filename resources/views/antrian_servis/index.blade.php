@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Antrian Servis</h1>
    
    <a href="{{ route('antrian-servis.create') }}" class="btn btn-primary mb-3">Tambah Antrian</a>
    
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
                    <th>Pelanggan</th>
                    <th>Kendaraan</th>
                    <th>Status</th>
                    <th>Mekanik</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($antrians as $index => $antrian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $antrian->pelanggan->nama }}</td>
                    <td>{{ $antrian->kendaraan->merk }} ({{ $antrian->kendaraan->nomor_plat }})</td>
                    <td>
                        <span class="badge 
                            @if($antrian->status == 'dalam antrian') bg-secondary
                            @elseif($antrian->status == 'sedang diservis') bg-warning text-dark
                            @else bg-success @endif">
                            {{ ucfirst(str_replace('_', ' ', $antrian->status)) }}
                        </span>
                    </td>
                    <td>{{ $antrian->karyawan ? $antrian->karyawan->nama : '-' }}</td>
                    <td>{{ $antrian->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('antrian-servis.show', $antrian->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('antrian-servis.edit', $antrian->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('antrian-servis.destroy', $antrian->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus antrian ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection