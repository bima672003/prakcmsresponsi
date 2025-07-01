@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Karyawan</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $karyawan->nama }}</h5>
            <p class="card-text">
                <strong>Jabatan:</strong> {{ ucfirst($karyawan->jabatan) }}<br>
                <strong>No Telepon:</strong> {{ $karyawan->no_telepon }}<br>
            </p>
            <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection