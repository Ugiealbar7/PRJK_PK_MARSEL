<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Dokumentasi Proyek</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon Bootstrap (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    @stack('css')
</head>

<body>
    {{-- ✅ NAVBAR DIPASANG DI SINI --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">ProyekKonstruksi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.projects.index') }}">Daftar Proyek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/tentang-kami') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/layanan') }}">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/kontak') }}">Kontak</a>
                    </li>
                </ul>
                <a href="{{ url('/dashboard') }}" class="btn btn-outline-light ms-3">Login Admin</a>
            </div>
        </div>
    </nav>

    {{-- ✅ ISI HALAMAN --}}
    <div class="container py-5">
        @yield('content')
    </div>

    {{-- Footer (opsional) --}}
    <footer class="bg-dark text-white text-center py-3">
        <small>© {{ date('Y') }} Proyek Konstruksi. All rights reserved.</small>
    </footer>

    <!-- JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('js')
</body>

</html>
