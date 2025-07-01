@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Transaksi Servis - TRX-{{ str_pad($transaksiServis->id, 5, '0', STR_PAD_LEFT) }}</h1>
        <a href="{{ route('transaksi-servis.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Transaksi</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>No. Antrian:</strong> {{ $transaksiServis->antrianServis->id }}</p>
                    <p><strong>Pelanggan:</strong> {{ $transaksiServis->antrianServis->kendaraan->pelanggan->nama }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total Biaya:</strong> Rp {{ number_format($transaksiServis->total_biaya, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $transaksiServis->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('transaksi-servis.update', $transaksiServis->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="karyawan_id" class="form-label">Kasir</label>
                    <select class="form-control @error('karyawan_id') is-invalid @enderror" id="karyawan_id" name="karyawan_id" required>
                        @foreach($kasirs as $kasir)
                            <option value="{{ $kasir->id }}" {{ old('karyawan_id', $transaksiServis->karyawan_id) == $kasir->id ? 'selected' : '' }}>
                                {{ $kasir->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('karyawan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                    <select class="form-control @error('metode_pembayaran') is-invalid @enderror" id="metode_pembayaran" name="metode_pembayaran" required>
                        <option value="tunai" {{ old('metode_pembayaran', $transaksiServis->metode_pembayaran) == 'tunai' ? 'selected' : '' }}>Tunai</option>
                        <option value="transfer" {{ old('metode_pembayaran', $transaksiServis->metode_pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                        <option value="kredit" {{ old('metode_pembayaran', $transaksiServis->metode_pembayaran) == 'kredit' ? 'selected' : '' }}>Kredit</option>
                    </select>
                    @error('metode_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection