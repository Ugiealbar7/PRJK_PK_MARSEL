@extends('front.layout.template')

@section('content')
    @push('css')
    @endpush
    <!-- HERO SECTION / Banner -->
    <div class="hero-banner" style="position: relative; background-color: #003366;">
        <img src="{{ asset('storage/back/WebKVBintaro Xchange.jpg') }}" alt="Banner" class="img-fluid w-100"
            style="max-height: 500px; object-fit: cover; opacity: 0.5;">
        <div class="text-overlay text-white text-center"
            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <h1 class="display-4 fw-bold">Dokumentasi Proyek Konstruksi</h1>
            <p class="lead">Lihat dan pantau perkembangan proyek mingguan secara real-time</p>
            <a href="{{ route('public.projects.index') }}" class="btn btn-glass px-4 py-2 mt-3">Lihat Daftar Proyek</a>
        </div>
    </div>

    <!-- SECTION INFO -->
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Proyek Terbaru</h5>
                        <p class="card-text">Cek proyek terbaru yang baru dimulai bulan ini.</p>
                        <a href="{{ route('public.projects.index') }}" class="btn btn-outline-primary">Lihat Proyek</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Progress Mingguan</h5>
                        <p class="card-text">Update video dan dokumentasi mingguan dari lapangan.</p>
                        <a href="{{ route('public.projects.index') }}" class="btn btn-outline-primary">Cek Progress</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Arsip Proyek</h5>
                        <p class="card-text">Lihat kembali seluruh proyek yang sudah selesai dibangun.</p>
                        <a href="{{ route('public.projects.index') }}" class="btn btn-outline-primary">Lihat Arsip</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
