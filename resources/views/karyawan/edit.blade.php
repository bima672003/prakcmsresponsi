@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Karyawan</h1>
    
    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $karyawan->nama) }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <select class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" required>
                <option value="kasir" {{ old('jabatan', $karyawan->jabatan) == 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="admin" {{ old('jabatan', $karyawan->jabatan) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="mekanik" {{ old('jabatan', $karyawan->jabatan) == 'mekanik' ? 'selected' : '' }}>Mekanik</option>
            </select>
            @error('jabatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="no_telepon">No Telepon</label>
            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $karyawan->no_telepon) }}" required>
            @error('no_telepon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection