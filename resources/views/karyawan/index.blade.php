@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Karyawan</h1>
    
    <a href="{{ route('karyawan.create') }}" class="btn btn-primary mb-3">Tambah Karyawan</a>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>No Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($karyawans as $index => $karyawan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $karyawan->nama }}</td>
                <td>{{ ucfirst($karyawan->jabatan) }}</td>
                <td>{{ $karyawan->no_telepon }}</td>
                <td>
                    <a href="{{ route('karyawan.show', $karyawan->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection