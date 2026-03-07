
@extends('layouts.app')

@section('content')
@include('components.navbar')

<main class="bg-light">
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center text-white" style="background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat; min-height: 70vh;">
        <div class="container text-center py-5" style="background: rgba(0,0,0,0.4); border-radius: 1rem;">
            <h1 class="display-3 fw-bold mb-3">Bukit Eon</h1>
            <p class="lead mb-4">Destinasi wisata alam, cafe & resto terbaik untuk liburan dan bersantai.</p>
            <a href="#cafe-resto" class="btn btn-warning btn-lg shadow">Lihat Cafe & Resto</a>
        </div>
    </section>

    <!-- Destinasi Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col text-center">
                    <h2 class="fw-bold">Destinasi Favorit</h2>
                    <p class="text-muted">Nikmati keindahan alam dan spot instagramable di Bukit Eon.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Puncak View">
                        <div class="card-body">
                            <h5 class="card-title">Puncak View</h5>
                            <p class="card-text">Panorama alam menakjubkan, cocok untuk sunrise dan sunset.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Taman Bunga">
                        <div class="card-body">
                            <h5 class="card-title">Taman Bunga</h5>
                            <p class="card-text">Spot foto warna-warni dengan berbagai jenis bunga indah.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://images.unsplash.com/photo-1502082553048-f009c37129b9?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Area Camping">
                        <div class="card-body">
                            <h5 class="card-title">Area Camping</h5>
                            <p class="card-text">Tempat nyaman untuk berkemah bersama keluarga & teman.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cafe & Resto Section -->
    <section id="cafe-resto" class="py-5 bg-white">
        <div class="container">
            <div class="row mb-4">
                <div class="col text-center">
                    <h2 class="fw-bold">Cafe & Resto</h2>
                    <p class="text-muted">Nikmati aneka makanan & minuman di cafe dan resto kami.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Cafe Bukit Eon">
                        <div class="card-body">
                            <h5 class="card-title">Cafe Bukit Eon</h5>
                            <p class="card-text">Tempat nongkrong cozy dengan kopi spesial dan view pegunungan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Resto Bukit Eon">
                        <div class="card-body">
                            <h5 class="card-title">Resto Bukit Eon</h5>
                            <p class="card-text">Menu makanan khas lokal dan internasional, cocok untuk keluarga.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@include('components.footer')
@endsection
