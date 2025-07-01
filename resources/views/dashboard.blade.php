<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bengkel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Style yang sudah ada tetap dipertahankan */
        .card {
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        /* ... (style lainnya tetap sama) ... */
        
        /* Tambahan style untuk navbar */
        .navbar {
            background-color: #2c3e50;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            color: white !important;
        }
        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            transition: all 0.3s;
            margin: 0 5px;
            border-radius: 4px;
        }
        .nav-link:hover, .nav-link.active {
            color: white !important;
            background-color: rgba(255,255,255,0.1);
        }
        .navbar-toggler {
            border-color: rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar Baru -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-car me-2"></i>Bengkel ABC
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('antrian-servis*') ? 'active' : '' }}" href="{{ route('antrian-servis.index') }}">
                            <i class="fas fa-list-ol me-1"></i> Antrian Servis
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pekerjaan-servis*') ? 'active' : '' }}" href="#">
                            <i class="fas fa-tools me-1"></i> Pekerjaan Servis
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('transaksi-servis*') ? 'active' : '' }}" href="{{ route('transaksi-servis.index') }}">
                            <i class="fas fa-receipt me-1"></i> Transaksi
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-database me-1"></i> Master Data
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('pelanggan.index') }}"><i class="fas fa-users me-1"></i> Pelanggan</a></li>
                            <li><a class="dropdown-item" href="{{ route('kendaraan.index') }}"><i class="fas fa-car me-1"></i> Kendaraan</a></li>
                            <li><a class="dropdown-item" href="{{ route('karyawan.index') }}"><i class="fas fa-user-tie me-1"></i> Karyawan</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-1"></i> Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Dashboard yang Sudah Ada -->
    <div class="container-fluid py-4">
        <!-- ... (seluruh konten dashboard yang sudah ada tetap sama) ... -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>