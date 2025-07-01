@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Pekerjaan Servis</h1>
        <a href="{{ route('pekerjaan-servis.index', $pekerjaanServis->antrian_servis_id) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Antrian</h5>
        </div>
        <div class="card-body">
            <p><strong>Pelanggan:</strong> {{ $pekerjaanServis->antrianServis->pelanggan->nama }}</p>
            <p><strong>Kendaraan:</strong> {{ $pekerjaanServis->antrianServis->kendaraan->merk }} ({{ $pekerjaanServis->antrianServis->kendaraan->nomor_plat }})</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pekerjaan-servis.update', $pekerjaanServis->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Pekerjaan</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $pekerjaanServis->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label for="biaya" class="form-label">Biaya (Rp)</label>
                    <input type="number" class="form-control @error('biaya') is-invalid @enderror" id="biaya" name="biaya" value="{{ old('biaya', $pekerjaanServis->biaya) }}" required>
                    @error('biaya')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection