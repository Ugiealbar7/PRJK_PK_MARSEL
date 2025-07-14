<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dokumentasi Proyek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}">
</head>

<body>
    {{-- ✅ NAVBAR DIPASANG DI SINI --}}
    <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark navbar-transparent fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">ProyekKonstruksi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('public.projects.index') }}">Daftar
                            Proyek</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/layanan') }}">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/kontak') }}">Kontak</a></li>
                </ul>
                <a href="{{ url('/dashboard') }}" class="btn btn-outline-light ms-3">Login Admin</a>
            </div>
        </div>
    </nav>


    {{-- ✅ ISI HALAMAN --}}
    <div class="">
        @yield('content')
    </div>

    {{-- Footer (opsional) --}}
    <footer class="bg-dark text-white text-center py-3">
        <small>© {{ date('Y') }} Proyek Konstruksi. All rights reserved.</small>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 2) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    </script>
</body>

</html>
