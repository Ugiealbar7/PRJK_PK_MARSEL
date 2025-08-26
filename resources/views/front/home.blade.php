@extends('front.layout.template')

@section('content')
<style>
/* HERO SECTION */
.hero-banner {
    position: relative;
    height: 500px;
    overflow: hidden;
    border-radius: 0 0 30px 30px;
}
.hero-banner img {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.6);
    opacity: 0;
    transition: opacity 1.2s ease-in-out, transform 0.6s ease;
}
.hero-banner img.active {
    opacity: 1;
    transform: scale(1.05);
}
.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    padding: 0 20px;
}
.hero-overlay h1 {
    font-weight: 800;
    font-size: 3rem;
    text-shadow: 0 3px 15px rgba(0,0,0,0.5);
}
.hero-overlay p {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-top: 10px;
}
.btn-hero {
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.4);
    color: white;
    padding: 12px 30px;
    border-radius: 30px;
    backdrop-filter: blur(6px);
    font-weight: 500;
    margin-top: 20px;
    transition: all 0.3s ease;
}
.btn-hero:hover {
    background: rgba(255,255,255,0.25);
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(255,255,255,0.2);
}

/* PROJECT CARDS */
.project-card {
    border-radius: 20px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.6s ease, transform 0.6s ease;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    display: flex;
    flex-direction: column;
    height: 100%;
    background: #fff;
    opacity: 0;
    transform: translateY(30px);
}
.project-card.visible {
    opacity: 1;
    transform: translateY(0);
}
.project-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}
.project-card img {
    height: 200px;
    object-fit: cover;
    width: 100%;
    transition: transform 0.4s ease;
}
.project-card:hover img {
    transform: scale(1.08);
}
.project-card-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}
.project-card-content h5 {
    font-weight: 700;
    font-size: 1.2rem;
    margin-bottom: 8px;
}
.project-card-content p {
    font-size: 0.95rem;
    color: #6c757d;
    line-height: 1.4;
    flex-grow: 1;
}
.project-card-content .date {
    font-size: 0.8rem;
    color: #adb5bd;
    margin-bottom: 10px;
}
.project-card-content .btn {
    align-self: flex-start;
}

/* Badge kategori */
.badge-category {
    position: absolute;
    top: 15px;
    left: 15px;
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    color: white;
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 0.75rem;
    text-transform: uppercase;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

/* RESPONSIVE */
@media(max-width: 768px){
    .hero-overlay h1 {
        font-size: 2.2rem;
    }
    .hero-overlay p {
        font-size: 1rem;
    }
    .project-card img {
        height: 160px;
    }
}
</style>

<!-- HERO SECTION -->
<div class="hero-banner mb-5">
<<<<<<< HEAD
    <img src="{{ asset('storage/banners/gambar1.jpg') }}" class="active" alt="Banner 1">
    <img src="{{ asset('storage/banners/gambar2.jpg') }}" alt="Banner 2">
    <img src="{{ asset('storage/banners/gambar3.jpg') }}" alt="Banner 3">
=======
    <img src="{{ asset('storage/back/gambar1.jpg') }}" class="active" alt="Banner 1">
    <img src="{{ asset('storage/back/gambar2.jpg') }}" alt="Banner 2">
    <img src="{{ asset('storage/back/gambar3.jpg') }}" alt="Banner 3">
>>>>>>> 4674b9287c573940fea55eb1b53314b324ebd7b3
    <div class="hero-overlay">
        <h1>📊 Dashboard Proyek Konstruksi</h1>
        <p>Pantau perkembangan proyek secara real-time & transparan</p>
        <a href="{{ route('public.projects.index') }}" class="btn-hero">
            🚀 Lihat Semua Proyek
        </a>
    </div>
</div>

<!-- LATEST PROJECTS -->
<div class="container">
    <h2 class="mb-4 fw-bold text-center text-gradient">Proyek Terbaru</h2>
    <div class="row g-4">
        @forelse($latestProjects as $project)
            @php
                $imagePath = $project->img && file_exists(storage_path('app/public/back/' . $project->img))
                    ? asset('storage/back/' . $project->img)
                    : asset('front/img/no-image.png');
            @endphp
            <div class="col-md-4">
                <div class="project-card position-relative">
                    <img src="{{ $imagePath }}" alt="{{ $project->title }}">
                    <span class="badge-category">{{ $project->category->name }}</span>
                    <div class="project-card-content d-flex flex-column">
                        <h5>{{ $project->title }}</h5>
                        <p>{{ \Illuminate\Support\Str::limit($project->desc, 120) }}</p>
                        <div class="date">{{ \Carbon\Carbon::parse($project->publish_date)->translatedFormat('d M Y') }}</div>
                        <a href="{{ route('public.projects.show', $project->slug) }}" class="btn btn-primary btn-sm">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center fst-italic text-secondary">Belum ada proyek terbaru.</p>
        @endforelse
    </div>
</div>

<!-- SLIDESHOW SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Banner slideshow
    let images = document.querySelectorAll(".hero-banner img");
    let currentIndex = 0;
    setInterval(() => {
        images[currentIndex].classList.remove("active");
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].classList.add("active");
    }, 5000);

    // Project cards fade-in animation
    const cards = document.querySelectorAll('.project-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    cards.forEach(card => observer.observe(card));
});
</script>
@endsection
