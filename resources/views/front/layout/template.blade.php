<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') - Dokumentasi Proyek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}" />
    <style>
        /* Biar navbar selalu terlihat */
        .navbar {
            background-color: #212529 !important; /* warna gelap */
        }

        /* Padding agar konten tidak ketimpa navbar */
        body {
            padding-top: 70px; /* sesuaikan tinggi navbar */
        }
    </style>
</head>

<body>
    {{-- ✅ NAVBAR FIXED --}}
    <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">ProyekKonstruksi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('public.projects.index') }}">Daftar Proyek</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/layanan') }}">Layanan</a></li>
                </ul>
                <!-- Tombol Login Admin -->
                <a href="{{ route('admin.login') }}" class="btn btn-outline-light ms-3">Login Admin</a>
            </div>
        </div>
    </nav>

    {{-- ✅ ISI HALAMAN --}}
    <div class="container py-5">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="bg-dark text-white text-center py-3">
        <small>© {{ date('Y') }} Proyek Konstruksi. All rights reserved.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
