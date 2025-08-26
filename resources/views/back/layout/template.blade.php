<!doctype html>
<html lang="en">

<style>
    body {
        background-color: #003569ff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #ffffffff;
    }

    /* Navbar */
    header.navbar {
        background-color: #002a55ff !important;
        color: #ffffffff;
    }

    header.navbar .navbar-brand {
        font-weight: 600;
        font-size: 1.1rem;
    }

    /* Card Style */
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }


    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
    }

    .card-title {
        font-weight: 600;
        color: #00274e;
    }

    input[placeholder="Search"]::placeholder {
        color: white;
        opacity: 1;
    }


    /* Sidebar */
    #sidebarMenu {
        background-color: #ffffffff;
    }

    #sidebarMenu .nav-link {
        color: #000000ff;
        font-weight: 500;
        border-radius: 6px;
        transition: background 0.2s ease, color 0.2s ease;
    }

    #sidebarMenu .nav-link:hover {
        background-color: rgba(0, 0, 0, 0.1);
        color: #01294e;
    }

    /* Search Box */
    .form-control-dark {
        background-color: #01294e;
        color: #fff;
        border: none;
    }

    .form-control-dark:focus {
        background-color: #02315e;
        color: #fff;
        box-shadow: none;
    }
</style>


<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>@yield('title')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('back/css/custom.css') }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <!-- Custom styles for this template -->
    <link href="{{ asset('back/css/dasboard.css') }}" rel="stylesheet">

    {{-- Panggil css dinamis per-halaman --}}
    @stack('css')
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="dashboard">Knowledge Management</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
<<<<<<< HEAD
                <a class="nav-link px-3" href="login" style="color: white;">Sign out</a>
=======
                <a class="nav-link px-3" href="#" style="color: white;">Sign out</a>
>>>>>>> 4674b9287c573940fea55eb1b53314b324ebd7b3
            </div>

        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            {{-- panggil sidebar menu --}}
            @include('back.layout.sidebar')

            {{-- panggil Section content --}}
            @yield('content')

            {{-- footer --}}
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>
    <script src="{{ asset('back/js/dashboard.js') }}"></script>

    @stack('js')
</body>

</html>
