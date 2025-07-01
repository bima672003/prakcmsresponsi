@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Pekerjaan Servis - Antrian #{{ $antrian->id }}</h1>
        <div>
            <a href="{{ route('antrian-servis.show', $antrian->id) }}" class="btn btn-info">
                <i class="fas fa-arrow-left"></i> Kembali ke Antrian
            </a>
            <a href="{{ route('pekerjaan-servis.create', $antrian->id) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pekerjaan
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Antrian</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Pelanggan:</strong> {{ $antrian->pelanggan->nama }}</p>
                    <p><strong>Kendaraan:</strong> {{ $antrian->kendaraan->merk }} ({{ $antrian->kendaraan->nomor_plat }})</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong> 
                        <span class="badge 
                            @if($antrian->status == 'dalam antrian') bg-secondary
                            @elseif($antrian->status == 'sedang diservis') bg-warning text-dark
                            @else bg-success @endif">
                            {{ ucfirst(str_replace('_', ' ', $antrian->status)) }}
                        </span>
                    </p>
                    <p><strong>Mekanik:</strong> {{ $antrian->karyawan ? $antrian->karyawan->nama : '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Deskripsi</th>
                    <th>Biaya</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($antrian->pekerjaanServis as $index => $pekerjaan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ Str::limit($pekerjaan->deskripsi, 50) }}</td>
                    <td>Rp {{ number_format($pekerjaan->biaya, 0, ',', '.') }}</td>
                    <td>{{ $pekerjaan->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('pekerjaan-servis.show', $pekerjaan->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('pekerjaan-servis.edit', $pekerjaan->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('pekerjaan-servis.destroy', $pekerjaan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pekerjaan ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr class="table-active">
                    <td colspan="2" class="text-end"><strong>Total Biaya:</strong></td>
                    <td><strong>Rp {{ number_format($antrian->pekerjaanServis->sum('biaya'), 0, ',', '.') }}</strong></td>
                    <td colspan="2"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection