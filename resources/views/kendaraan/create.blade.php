@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kendaraan Baru</h1>
    
    <form action="{{ route('kendaraan.store') }}" method="POST">
        @csrf
        
        <div class="form-group mb-3">
            <label for="pelanggan_id">Pemilik Kendaraan</label>
            <select class="form-control @error('pelanggan_id') is-invalid @enderror" id="pelanggan_id" name="pelanggan_id" required>
                <option value="">Pilih Pemilik</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}" {{ old('pelanggan_id') == $pelanggan->id ? 'selected' : '' }}>
                        {{ $pelanggan->nama }} ({{ $pelanggan->no_telepon }})
                    </option>
                @endforeach
            </select>
            @error('pelanggan_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3">
            <label for="merek">Merek Kendaraan</label>
            <input type="text" class="form-control @error('merek') is-invalid @enderror" id="merek" name="merek" value="{{ old('merek') }}" required>
            @error('merek')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3">
            <label for="nomor_plat">Nomor Plat</label>
            <input type="text" class="form-control @error('nomor_plat') is-invalid @enderror" id="nomor_plat" name="nomor_plat" value="{{ old('nomor_plat') }}" required>
            @error('nomor_plat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3">
            <label for="tahun_pembuatan">Tahun Pembuatan</label>
            <input type="text" class="form-control @error('tahun_pembuatan') is-invalid @enderror" id="tahun_pembuatan" name="tahun_pembuatan" value="{{ old('tahun_pembuatan') }}" required maxlength="4" pattern="\d{4}" title="Masukkan 4 digit tahun">
            @error('tahun_pembuatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection