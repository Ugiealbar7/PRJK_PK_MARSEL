@extends('front.layout.template')

@section('title', $project->title)

@section('content')
{{-- Hero Section --}}
<section class="hero-section position-relative text-white">
    @if($project->img && file_exists(storage_path('app/public/back/' . $project->img)))
        <div class="hero-bg parallax-bg" 
            style="background-image: url('{{ Storage::url('back/' . $project->img) }}');">
        </div>
    @endif
    <div class="container position-relative z-2 py-5">
        <h1 class="fw-bold display-4 animate__animated animate__fadeInDown">{{ $project->title }}</h1>
        <span class="badge bg-gradient-primary px-3 py-2">{{ $project->category->name }}</span>
        <p class="mt-2 text-light">
            <i class="bi bi-calendar-event"></i>
            {{ \Carbon\Carbon::parse($project->publish_date)->translatedFormat('d F Y') }}
        </p>

        {{-- Share Buttons --}}
        <div class="d-flex gap-2 mt-3">
            <a href="https://wa.me/?text={{ urlencode($project->title . ' - ' . url()->current()) }}" target="_blank" 
               class="btn btn-whatsapp">
                <i class="bi bi-whatsapp"></i> WhatsApp
            </a>
            <a href="https://www.instagram.com/?url={{ urlencode(url()->current()) }}" target="_blank" 
               class="btn btn-instagram">
                <i class="bi bi-instagram"></i> Instagram
            </a>
        </div>
    </div>
</section>

{{-- Main Content --}}
<div class="container mt-5">
    <div class="row gy-5">
        {{-- Left Content --}}
        <div class="col-lg-8" data-aos="fade-up">
            {{-- Main Image --}}
            <div class="image-wrapper mb-4 shadow-lg rounded overflow-hidden">
                @if($project->img && file_exists(storage_path('app/public/back/' . $project->img)))
                    <img src="{{ Storage::url('back/' . $project->img) }}" 
                         alt="{{ $project->title }}" 
                         class="img-fluid">
                @else
                    <div class="p-5 text-center text-muted">Tidak ada foto proyek</div>
                @endif
            </div>

            {{-- Description --}}
            <div class="content-box shadow-sm p-4 rounded">
                {!! nl2br(e($project->desc)) !!}
            </div>
        </div>

        {{-- Right Content: Weekly Progress --}}
        <div class="col-lg-4" data-aos="fade-left">
            <h4 class="fw-bold mb-3 text-gradient">Progress Mingguan</h4>
            @if($progresses->count())
                <div class="progress-list">
                    @foreach($progresses as $progress)
                        <div class="progress-card mb-3 p-3 rounded shadow-sm" data-aos="zoom-in">
                            <h6 class="fw-bold text-primary">Minggu {{ $progress->week }} - {{ $progress->title }}</h6>
                            <p class="mb-2">{{ $progress->description }}</p>
                            @if (!empty($progress->video_path) && file_exists(storage_path('app/public/videos/' . $progress->video_path)))
                                <div class="video-wrapper ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                                    <video controls preload="metadata">
                                        <source src="{{ Storage::url('videos/' . $progress->video_path) }}" type="video/mp4">
                                    </video>
                                </div>
                            @else
                                <small class="text-muted fst-italic">Tidak ada video progress</small>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted fst-italic">Belum ada progress mingguan.</p>
            @endif
        </div>
    </div>
</div>

{{-- Styles --}}
<style>
    /* Hero Section */
    .hero-section {
        min-height: 350px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .hero-bg {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-size: cover;
        background-position: center;
        filter: brightness(0.5);
        z-index: 1;
        will-change: transform;
        transform: translateY(0);
        transition: transform 0.1s linear;
    }
    .bg-gradient-primary {
        background: linear-gradient(90deg, #007bff, #6610f2);
        color: white;
    }
    .text-gradient {
        background: linear-gradient(90deg, #007bff, #6610f2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Main Image - Limited Size */
    .image-wrapper {
        max-height: 450px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .image-wrapper img {
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: cover;
        transition: transform .4s ease;
    }
    .image-wrapper:hover img {
        transform: scale(1.05);
    }
    @media (max-width: 768px) {
        .image-wrapper {
            max-height: 300px;
        }
    }

    /* Content Box */
    .content-box {
        background: white;
        border-radius: 0.75rem;
        line-height: 1.8;
    }

    /* Progress Cards */
    .progress-card {
        background: #f8f9fa;
        border-left: 4px solid #007bff;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .progress-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    /* Video */
    .video-wrapper video {
        border-radius: 0.5rem;
    }

    /* Share Buttons */
    .btn-whatsapp {
        background: #25d366;
        color: white;
        transition: 0.3s;
    }
    .btn-whatsapp:hover {
        background: #1ebe5b;
        color: white;
    }
    .btn-instagram {
        background: linear-gradient(45deg, #f58529, #dd2a7b, #8134af, #515bd4);
        color: white;
        transition: 0.3s;
    }
    .btn-instagram:hover {
        opacity: 0.85;
        color: white;
    }
</style>

{{-- Scripts for Parallax & Animation --}}
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<script>
    // Init AOS Animation
    AOS.init({
        duration: 800,
        once: true
    });

    // Parallax effect
    document.addEventListener('scroll', function() {
        const scrolled = window.scrollY;
        document.querySelectorAll('.parallax-bg').forEach(bg => {
            bg.style.transform = 'translateY(' + scrolled * 0.3 + 'px)';
        });
    });
</script>
@endsection
