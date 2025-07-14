@extends('back.layout.template')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('title', 'Dashboard Admin')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard Admin</h1>
        </div>

        <!-- Info Boxes -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-bg-primary">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-folder"></i> Total Proyek</h5>
                        <p class="card-text fs-4">{{ $totalProjects }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-success">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-layers"></i> Kategori</h5>
                        <p class="card-text fs-4">{{ $totalCategories }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-warning">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-collection-play"></i> Progress</h5>
                        <p class="card-text fs-4">{{ $totalProgress }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-danger">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-eye"></i> Total Views</h5>
                        <p class="card-text fs-4">{{ $totalViews }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <strong>Proyek Terbaru</strong>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($recentProjects as $project)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ $project->title }}</span>
                        <small class="text-muted">{{ $project->created_at->format('d M Y') }}</small>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Chart Progress Mingguan -->
        <div class="card">
            <div class="card-header bg-light">
                <strong>Grafik Progress Mingguan</strong>
            </div>
            <div class="card-body">
                <canvas id="progressChart" height="100"></canvas>
            </div>
        </div>
    </main>
@endsection

@push('js')
    <script>
        const ctx = document.getElementById('progressChart').getContext('2d');
        const progressChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($progressWeeks) !!},
                datasets: [{
                    label: 'Jumlah Progress',
                    data: {!! json_encode($progressCounts) !!},
                    backgroundColor: '#0d6efd'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
