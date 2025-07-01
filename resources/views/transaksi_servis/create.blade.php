@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Buat Transaksi Servis - Antrian #{{ $antrian->id }}</h1>
        <a href="{{ route('antrian-servis.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Ringkasan Servis</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Pelanggan:</strong> {{ $antrian->kendaraan->pelanggan->nama }}</p>
                    <p><strong>Kendaraan:</strong> {{ $antrian->kendaraan->merk }} ({{ $antrian->kendaraan->nomor_plat }})</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total Biaya:</strong> Rp {{ number_format($totalBiaya, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('transaksi-servis.store', $antrian->id) }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="karyawan_id" class="form-label">Kasir</label>
                    <select class="form-control @error('karyawan_id') is-invalid @enderror" id="karyawan_id" name="karyawan_id" required>
                        <option value="">Pilih Kasir</option>
                        @foreach($kasirs as $kasir)
                            <option value="{{ $kasir->id }}" {{ old('karyawan_id') == $kasir->id ? 'selected' : '' }}>
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
                        <option value="">Pilih Metode</option>
                        <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                        <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                        <option value="kredit" {{ old('metode_pembayaran') == 'kredit' ? 'selected' : '' }}>Kredit</option>
                    </select>
                    @error('metode_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection