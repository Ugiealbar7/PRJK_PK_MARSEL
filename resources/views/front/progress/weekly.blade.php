@extends('front.layout.template')

@section('title', 'Progres Mingguan')

@section('content')
<div class="container mt-5">
    {{-- Judul Halaman --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5 text-gradient animate__animated animate__fadeInDown">
            📅 Progres Mingguan
        </h1>
        <p class="text-muted">Update perkembangan proyek setiap minggu</p>
    </div>

    @if ($progressList->count())
        <div class="row g-4">
            @foreach ($progressList as $progress)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 shadow-sm progress-card overflow-hidden">
                        
                        {{-- Video Preview (Thumbnail Otomatis) --}}
                        @if($progress->video_path)
                            <div class="video-wrapper position-relative" 
                                 data-video="{{ asset('storage/videos/' . $progress->video_path) }}">
                                <video preload="metadata" muted class="w-100 d-block video-preview" 
                                       style="max-height: 200px; object-fit: cover;">
                                    <source src="{{ asset('storage/videos/' . $progress->video_path) }}#t=0.1" type="video/mp4">
                                </video>
                                <span class="video-overlay play-btn">
                                    <i class="bi bi-play-circle-fill fs-1 text-white"></i>
                                </span>
                            </div>
                        @endif

                        {{-- Konten --}}
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold mb-2 text-dark">{{ $progress->title }}</h5>

                            @if($progress->week)
                                <span class="badge bg-gradient-primary mb-3">Minggu {{ $progress->week }}</span>
                            @endif

                            <p class="text-muted flex-grow-1">
                                {{ Str::limit($progress->description, 100) }}
                            </p>
                        </div>

                        {{-- Footer --}}
                        <div class="card-footer bg-white border-0 text-end">
                            <a href="{{ route('public.progress.show', ['id' => $progress->id]) }}" 
                               class="btn btn-gradient btn-sm px-3">
                                Lihat Detail <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $progressList->links() }}
        </div>
    @else
        <div class="alert alert-info text-center py-4 rounded-3 shadow-sm">
            <i class="bi bi-info-circle"></i> Belum ada progres mingguan.
        </div>
    @endif
</div>

{{-- Custom Styles --}}
<style>
    /* Gradien */
    .text-gradient {
        background: linear-gradient(45deg, #007bff, #6610f2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .bg-gradient-primary {
        background: linear-gradient(90deg, #007bff, #6610f2);
        color: #fff;
    }
    .btn-gradient {
        background: linear-gradient(90deg, #007bff, #6610f2);
        color: white;
        border: none;
        transition: 0.3s;
    }
    .btn-gradient:hover {
        opacity: 0.85;
        color: white;
        transform: translateY(-2px);
    }

    /* Card Efek */
    .progress-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        background: white;
    }
    .progress-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    /* Video Preview Efek */
    .video-wrapper {
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    .video-overlay {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .video-wrapper:hover .video-overlay {
        opacity: 1;
    }
    .play-btn {
        background: rgba(0,0,0,0.4);
        border-radius: 50%;
        padding: 10px 15px;
    }
</style>

{{-- Animations & Lazy Load Script --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.video-wrapper').forEach(wrapper => {
            wrapper.addEventListener('click', function() {
                const videoSrc = this.getAttribute('data-video');
                const video = document.createElement('video');
                video.src = videoSrc;
                video.controls = true;
                video.autoplay = true;
                video.classList.add('w-100');
                video.style.maxHeight = '200px';
                video.style.objectFit = 'cover';
                this.innerHTML = '';
                this.appendChild(video);
            });
        });
    });
</script>
@endsection
