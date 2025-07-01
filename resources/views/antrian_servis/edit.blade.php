@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Antrian Servis</h1>
    
    <form action="{{ route('antrian-servis.update', $antrianServis->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label>Pelanggan</label>
            <input type="text" class="form-control" value="{{ $antrianServis->pelanggan->nama }}" readonly>
        </div>
        
        <div class="form-group mb-3">
            <label>Kendaraan</label>
            <input type="text" class="form-control" value="{{ $antrianServis->kendaraan->merk }} ({{ $antrianServis->kendaraan->nomor_plat }})" readonly>
        </div>
        
        <div class="form-group mb-3">
            <label for="karyawan_id">Mekanik</label>
            <select class="form-control @error('karyawan_id') is-invalid @enderror" id="karyawan_id" name="karyawan_id">
                <option value="">Pilih Mekanik</option>
                @foreach($mekaniks as $mekanik)
                    <option value="{{ $mekanik->id }}" 
                        {{ (old('karyawan_id', $antrianServis->karyawan_id) == $mekanik->id) ? 'selected' : '' }}>
                        {{ $mekanik->nama }}
                    </option>
                @endforeach
            </select>
            @error('karyawan_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="dalam antrian" {{ old('status', $antrianServis->status) == 'dalam antrian' ? 'selected' : '' }}>Dalam Antrian</option>
                <option value="sedang diservis" {{ old('status', $antrianServis->status) == 'sedang diservis' ? 'selected' : '' }}>Sedang Diservis</option>
                <option value="selesai" {{ old('status', $antrianServis->s