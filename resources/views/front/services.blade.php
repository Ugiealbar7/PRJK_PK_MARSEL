@extends('front.layout.template')

@section('title', 'Layanan Kami')

@section('content')
<style>
/* HERO SECTION */
.hero-services {
    position: relative;
    height: 320px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0072ff, #00c6ff);
    border-radius: 0 0 40px 40px;
    color: white;
    text-align: center;
    padding: 0 20px;
    overflow: hidden;
}
.hero-services h1 {
    font-size: 3rem;
    font-weight: 900;
    margin-bottom: 15px;
    background: linear-gradient(45deg, #fff, #f9f9f9ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.hero-services p {
    font-size: 1.2rem;
    opacity: 0.9;
}

/* SERVICES SECTION */
.services-section {
    margin: 80px 0;
}
.services-section h2 {
    text-align: center;
    font-weight: 900;
    margin-bottom: 15px;
    font-size: 2.8rem;
    background: linear-gradient(45deg, #0072ff, #00c6ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.services-section p.lead {
    text-align: center;
    color: #6c757d;
    margin-bottom: 50px;
}

/* SERVICE CARDS */
.service-card {
    background: #fff;
    border-radius: 25px;
    padding: 40px 20px;
    text-align: center;
    box-shadow: 0 12px 35px rgba(0,0,0,0.1);
    transition: transform 0.6s ease, box-shadow 0.6s ease;
    cursor: pointer;
    perspective: 1200px;
    opacity: 0;
    transform: translateY(50px);
}
.service-card.visible {
    opacity: 1;
    transform: translateY(0);
}
.service-card:hover {
    transform: rotateY(10deg) translateY(-15px) scale(1.05);
    box-shadow: 0 25px 50px rgba(0,0,0,0.2);
}

/* FULL CIRCLE ICON */
.service-card .service-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 25px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, #0072ff, #00c6ff);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    transition: transform 0.5s ease, box-shadow 0.5s ease;
}
.service-card .service-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* pastikan foto menutupi bulatan */
    transition: transform 0.5s ease;
}
.service-card:hover .service-icon {
    transform: scale(1.15);
    box-shadow: 0 12px 30px rgba(0,0,0,0.25);
}
.service-card:hover .service-icon img {
    transform: scale(1.1);
}

.service-card h5 {
    font-weight: 800;
    font-size: 1.3rem;
    margin-bottom: 15px;
}
.service-card p {
    font-size: 0.95rem;
    color: #6c757d;
    line-height: 1.5;
}

/* Responsive */
@media(max-width:768px){
    .hero-services h1 {
        font-size: 2.2rem;
    }
    .hero-services p {
        font-size: 1rem;
    }
    .service-card {
        padding: 25px 15px;
    }
    .service-card .service-icon {
        width: 90px;
        height: 90px;
        margin-bottom: 15px;
    }
}
</style>

<!-- HERO -->
<div class="hero-services mb-5">
    <div>
        <h1>🌐 Layanan Kami</h1>
        <p>Memberikan solusi pemantauan proyek konstruksi secara real-time dan transparan</p>
    </div>
</div>

<!-- SERVICES -->
<div class="container services-section">
    <h2>Layanan Unggulan</h2>
    <p class="lead">Kami menyediakan berbagai layanan untuk mendukung pengelolaan proyek konstruksi secara profesional.</p>
    <div class="row g-4 justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="service-card">
                <div class="service-icon">
                    <img src="{{ asset('storage/back/icon-monitoring.jpg') }}" alt="Monitoring Proyek">
                </div>
                <h5>Monitoring Proyek</h5>
                <p>Memantau perkembangan proyek secara real-time dengan dashboard interaktif, memastikan setiap progres tercatat akurat.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="service-card">
                <div class="service-icon">
                    <img src="{{ asset('storage/back/icon-dokumentasi.jpg') }}" alt="Dokumentasi Lapangan">
                </div>
                <h5>Dokumentasi Lapangan</h5>
                <p>Menyediakan foto, video, dan laporan lapangan yang terdokumentasi sistematis dan mudah diakses oleh semua tim.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="service-card">
                <div class="service-icon">
                    <img src="{{ asset('storage/back/icon-laporan.jpg') }}" alt="Laporan Analitik">
                </div>
                <h5>Laporan Analitik</h5>
                <p>Menyediakan laporan analitik yang membantu manajemen proyek dalam pengambilan keputusan cepat dan tepat.</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(){
    const cards = document.querySelectorAll('.service-card');
    const observer = new IntersectionObserver(entries => {
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
