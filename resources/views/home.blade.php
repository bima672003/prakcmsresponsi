<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bengkel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .card {
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-header {
            border-radius: 10px 10px 0 0 !important;
        }
        .stat-card {
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .badge-secondary {
            background-color: #6c757d;
        }
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .badge-success {
            background-color: #28a745;
        }
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Bima Bengkel Servis</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">Pelanggan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}" href="{{ route('kendaraan.index') }}">Kendaraan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('karyawan.*') ? 'active' : '' }}" href="{{ route('karyawan.index') }}">Mekanik</a>
        </li>
    </ul>
</div>

    </nav>

    <!-- Main Content -->
    <div class="container-fluid py-4">
        <h1 class="mb-4">Dashboard Bengkel</h1>

        <!-- Statistik Utama -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card border-start border-primary border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Total Pelanggan</h6>
                                <h4 class="mb-0">{{ $totalPelanggan }}</h4>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card border-start border-success border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Total Kendaraan</h6>
                                <h4 class="mb-0">{{ $totalKendaraan }}</h4>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="fas fa-car fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card border-start border-info border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Total Mekanik</h6>
                                <h4 class="mb-0">{{ $totalMekanik }}</h4>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <i class="fas fa-tools fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card border-start border-warning border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Pendapatan Hari Ini</h6>
                                <h4 class="mb-0">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h4>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="fas fa-money-bill-wave fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Antrian Berjalan -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Antrian Berjalan</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pelanggan</th>
                                        <th>Kendaraan</th>
                                        <th>Mekanik</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($antrianBerjalan as $antrian)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $antrian->pelanggan->nama }}</td>
                                        <td>{{ $antrian->kendaraan->merek }} ({{ $antrian->kendaraan->nomor_plat }})</td>
                                        <td>{{ $antrian->karyawan ? $antrian->karyawan->nama : '-' }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($antrian->status == 'dalam antrian') bg-secondary
                                                @elseif($antrian->status == 'sedang diservis') bg-warning text-dark
                                                @else bg-success @endif">
                                                {{ ucfirst($antrian->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada antrian berjalan</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi Terakhir -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Transaksi Terakhir</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pelanggan</th>
                                        <th>Kendaraan</th>
                                        <th>Total</th>
                                        <th>Metode</th>
                                        <th>Kasir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transaksiTerakhir as $transaksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->antrianServis->pelanggan->nama }}</td>
                                        <td>{{ $transaksi->antrianServis->kendaraan->merek }}</td>
                                        <td>Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}</td>
                                        <td>{{ ucfirst($transaksi->metode_pembayaran) }}</td>
                                        <td>{{ $transaksi->karyawan->nama }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada transaksi terakhir</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
