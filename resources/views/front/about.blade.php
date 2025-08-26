@extends('front.layout.template')

@section('title', 'Tentang Kami')

@section('content')
<style>
/* HERO SECTION */
.hero-about {
    position: relative;
    height: 500px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('storage/back/gambar1.jpg') }}') center/cover no-repeat;
    border-radius: 0 0 50px 50px;
}

.hero-overlay {
    position: relative;
    z-index: 2;
    text-align: center;
    color: #fff;
    padding: 0 20px;
    animation: fadeInDown 1s ease forwards;
}

.hero-overlay h1 {
    font-size: 3.2rem;
    font-weight: 900;
    margin-bottom: 15px;
    text-shadow: 0 4px 20px rgba(0,0,0,0.6);
}

.hero-overlay p {
    font-size: 1.3rem;
    margin-bottom: 25px;
}

.btn-hero {
    background: linear-gradient(90deg, #007bff, #00d4ff);
    color: white;
    padding: 14px 35px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-hero:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

/* ABOUT SECTION */
.about-section {
    margin-top: 60px;
    padding-bottom: 60px;
}

.about-section h2 {
    text-align: center;
    font-weight: 900;
    font-size: 2.8rem;
    margin-bottom: 50px;
    color: #222;
}

.about-section p {
    line-height: 1.8;
    color: #555;
    font-size: 1.1rem;
}

/* CARDS MISI, VISI, NILAI */
.about-cards .card {
    border-radius: 25px;
    padding: 35px 25px;
    transition: all 0.4s ease;
    box-shadow: 0 12px 30px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    background: #fff;
    text-align: center;
}

.about-cards .card:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 18px 40px rgba(0,0,0,0.12);
}

.about-cards .card img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto 20px auto;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.about-cards .card:hover img {
    transform: rotate(10deg) scale(1.15);
}

.about-cards h5 {
    font-weight: 700;
    margin-bottom: 20px;
    font-size: 1.4rem;
    color: #007bff;
}

.about-cards p {
    color: #6c757d;
    font-size: 1rem;
}

/* Animasi fade-in */
.fade-in {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease;
}
.fade-in.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Keyframes */
@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media(max-width:992px){
    .hero-overlay h1 {
        font-size: 2.5rem;
    }
    .hero-overlay p {
        font-size: 1.1rem;
    }
    .about-cards .card img {
        width: 80px;
        height: 80px;
    }
}

@media(max-width:768px){
    .hero-overlay h1 {
        font-size: 2rem;
    }
    .hero-overlay p {
        font-size: 1rem;
    }
    .about-cards .card {
        padding: 30px 15px;
    }
}
</style>

<!-- HERO -->
<div class="hero-about mb-5">
    <div class="hero-overlay">
        <h1>Tentang Kami</h1>
        <p>Pantau perkembangan proyek secara real-time & transparan</p>
        <a href="{{ route('public.projects.index') }}" class="btn-hero">
            🚀 Lihat Semua Proyek
        </a>
    </div>
</div>

<!-- CONTENT -->
<div class="container about-section">
    <div class="row mb-5 fade-in">
        <div class="col-md-12 text-center">
            <p>Kami adalah tim profesional yang berkomitmen menghadirkan informasi proyek konstruksi secara transparan dan real-time. Platform ini memudahkan Anda memantau perkembangan proyek dan mengakses dokumentasi lapangan dengan akurat dan mudah.</p>
        </div>
    </div>

    <!-- CARDS MISI, VISI, NILAI -->
    <div class="row g-4 about-cards justify-content-center">
        <div class="col-lg-4 col-md-6 fade-in d-flex">
            <div class="card flex-fill">
                <img src="{{ asset('storage/back/gambar2.jpg') }}" alt="Misi">
                <h5>Misi</h5>
                <p>Memberikan update proyek konstruksi secara transparan, akurat, dan mudah diakses oleh semua pemangku kepentingan. Kami berkomitmen menghadirkan informasi yang real-time, mempermudah pengambilan keputusan, dan memastikan setiap progres proyek terdokumentasi dengan baik.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 fade-in d-flex">
            <div class="card flex-fill">
                <img src="{{ asset('storage/back/gambar3.jpg') }}" alt="Visi">
                <h5>Visi</h5>
                <p>Menjadi platform monitoring proyek konstruksi terpercaya yang mampu menghubungkan tim proyek, klien, dan publik secara efektif. Kami ingin menciptakan ekosistem yang transparan, profesional, dan inovatif sehingga setiap proyek dapat berjalan dengan optimal dan tepat waktu.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 fade-in d-flex">
            <div class="card flex-fill">
                <img src="{{ asset('storage/back/gambar1.jpg') }}" alt="Nilai">
                <h5>Nilai</h5>
                <p>Kami menjunjung tinggi profesionalisme, akurasi, transparansi, dan inovasi dalam setiap aspek kerja. Setiap informasi yang kami hadirkan didukung data yang valid, sehingga membangun kepercayaan, meningkatkan efisiensi, dan mendukung kesuksesan proyek secara berkelanjutan.</p>
            </div>
        </div>
    </div>
</div>

<script>
// Fade-in animation
document.addEventListener("DOMContentLoaded", function () {
    const faders = document.querySelectorAll('.fade-in');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    faders.forEach(fader => observer.observe(fader));
});
</script>
@endsection
