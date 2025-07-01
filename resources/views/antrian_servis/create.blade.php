@extends('layouts.app')

@section('title', 'Tambah Antrian Servis')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-plus-circle mr-2"></i>Tambah Antrian Servis</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('antrian-servis.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kendaraan_id">Kendaraan <span class="text-danger">*</span></label>
                                <select class="form-control @error('kendaraan_id') is-invalid @enderror" id="kendaraan_id" name="kendaraan_id" required>
                                    <option value="">Pilih Kendaraan</option>
                                    @foreach($kendaraans as $kendaraan)
                                        <option value="{{ $kendaraan->id }}" {{ old('kendaraan_id') == $kendaraan->id ? 'selected' : '' }}>
                                            {{ $kendaraan->merek }} ({{ $kendaraan->nomor_plat }}) - {{ $kendaraan->pelanggan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kendaraan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="karyawan_id">Mekanik</label>
                                <select class="form-control @error('karyawan_id') is-invalid @enderror" id="karyawan_id" name="karyawan_id">
                                    <option value="">Pilih Mekanik</option>
                                    @foreach($mekaniks as $mekanik)
                                        <option value="{{ $mekanik->id }}" {{ old('karyawan_id') == $mekanik->id ? 'selected' : '' }}>
                                            {{ $mekanik->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('karyawan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan Tambahan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="2">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('antrian-servis.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection