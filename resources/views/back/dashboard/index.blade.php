@extends('back.layout.template')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* Style untuk info box */
    .info-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 12px;
    }
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    /* List proyek terbaru */
    .list-group-item {
        transition: background-color 0.2s ease, padding-left 0.2s ease;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
        padding-left: 10px;
    }

    /* Card umum */
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    .card-header {
        font-weight: bold;
    }

    /* Chart wrapper */
    .card-body canvas {
        background: rgba(0, 0, 0, 0.02);
        padding: 10px;
        border-radius: 8px;
    }
</style>

@section('title', 'Dashboard Admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard Admin</h1>
    </div>

    <!-- Info Boxes -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary info-card">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-folder"></i> Total Proyek</h5>
                    <p class="card-text fs-4">{{ $totalProjects }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success info-card">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-layers"></i> Kategori</h5>
                    <p class="card-text fs-4">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning info-card">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-collection-play"></i> Progress</h5>
                    <p class="card-text fs-4">{{ $totalProgress }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-danger info-card">
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
