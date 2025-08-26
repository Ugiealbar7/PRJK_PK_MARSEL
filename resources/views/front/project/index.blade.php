@extends('front.layout.template')

@section('title', '📌 Proyek Terbaru')

@section('content')
<div class="container mt-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
            <h2 class="fw-bold text-gradient m-0">📌 Proyek Terbaru</h2>
            <p class="text-muted mb-0">Lihat perkembangan proyek terbaru Anda</p>
        </div>
        <a href="{{ route('public.projects.index') }}" class="btn btn-gradient px-4 fw-semibold shadow-sm">
            Semua Proyek <i class="bi bi-arrow-right-circle ms-1"></i>
        </a>
    </div>

    @if ($projects->count())
        <div class="row g-4">
            @foreach ($projects as $project)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 shadow-sm project-card">
                        
                        {{-- Gambar Proyek --}}
                        <div class="position-relative overflow-hidden rounded-top-4">
                            @php
                                $imagePath = storage_path('app/public/back/' . $project->img);
                            @endphp
                            @if($project->img && file_exists($imagePath))
                                <img src="{{ asset('storage/back/' . $project->img) }}" 
                                     class="card-img-top img-hover-zoom" 
                                     alt="{{ $project->title }}" 
                                     style="height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('front/img/no-image.png') }}" 
                                     class="card-img-top" 
                                     alt="Tidak ada foto"
                                     style="height: 200px; object-fit: cover;">
                            @endif

                            {{-- Badge Kategori --}}
                            <span class="badge bg-gradient position-absolute top-0 start-0 m-3 shadow-sm category-badge">
                                {{ $project->category->name }}
                            </span>
                        </div>

                        {{-- Body Card --}}
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="fw-bold mb-2">{{ $project->title }}</h5>
                            <p class="text-muted flex-grow-1">{{ \Illuminate\Support\Str::limit($project->desc, 120) }}</p>
                            
                            {{-- Progress Bar --}}
                            @php
                                $progressValue = $project->progress ?? 0; // Pastikan field progress ada di model
                            @endphp
                            <div class="mb-3">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progres</span>
                                    <span class="fw-semibold">{{ $progressValue }}%</span>
                                </div>
                                <div class="progress" style="height: 8px; border-radius: 50px;">
                                    <div class="progress-bar bg-gradient" role="progressbar" 
                                         style="width: {{ $progressValue }}%;" 
                                         aria-valuenow="{{ $progressValue }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>

                            {{-- Tanggal Publish --}}
                            <div class="d-flex align-items-center text-muted small mb-3">
                                <i class="bi bi-calendar-event me-2"></i>
                                {{ \Carbon\Carbon::parse($project->publish_date)->translatedFormat('d M Y') }}
                            </div>

                            {{-- Tombol Detail --}}
                            <a href="{{ route('public.projects.show', $project->slug) }}" 
                               class="btn btn-gradient mt-auto px-3 py-2 fw-semibold">
                                <i class="bi bi-eye me-1"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $projects->links() }}
        </div>
    @else
        <div class="alert alert-info text-center py-4 rounded-3 shadow-sm">
            <i class="bi bi-info-circle"></i> Tidak ada proyek yang tersedia.
        </div>
    @endif
</div>

{{-- Custom Styles --}}
<style>
    .text-gradient {
        background: linear-gradient(45deg, #4f46e5, #0ea5e9);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .bg-gradient {
        background: linear-gradient(45deg, #4f46e5, #0ea5e9);
        color: #fff;
    }
    .btn-gradient {
        background: linear-gradient(45deg, #4f46e5, #0ea5e9);
        color: #fff;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-gradient:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
    .project-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        background: white;
    }
    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.08);
    }
    .img-hover-zoom {
        transition: transform 0.4s ease;
    }
    .project-card:hover .img-hover-zoom {
        transform: scale(1.05);
    }
    .category-badge {
        font-size: 0.75rem;
        padding: 0.4em 0.75em;
        border-radius: 0.375rem;
    }
</style>
@endsection
