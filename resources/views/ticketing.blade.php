@extends('layouts.app')

@section('content')
@include('components.navbar')

<main class="bg-light py-5 min-vh-100">
    <div class="container">
        <h1 class="text-center fw-bold mb-5">Pemesanan Tiket Wisata</h1>
        <div class="row g-4">
            <!-- Camping Ground -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Camping Ground">
                    <div class="card-body text-center">
                        <h5 class="card-title">Camping Ground</h5>
                        <p class="card-text">Nikmati pengalaman berkemah seru di alam terbuka Bukit Eon.</p>
                        <span class="fw-bold text-success d-block mb-3">Rp 50.000 / malam</span>
                        <button class="btn btn-success">Pesan Tiket</button>
                    </div>
                </div>
            </div>
            <!-- Flying Fox -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://images.unsplash.com/photo-1502082553048-f009c37129b9?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Flying Fox">
                    <div class="card-body text-center">
                        <h5 class="card-title">Flying Fox</h5>
                        <p class="card-text">Rasakan sensasi meluncur di atas lembah dengan aman dan seru.</p>
                        <span class="fw-bold text-success d-block mb-3">Rp 25.000 / orang</span>
                        <button class="btn btn-success">Pesan Tiket</button>
                    </div>
                </div>
            </div>
            <!-- Outbound -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Outbound">
                    <div class="card-body text-center">
                        <h5 class="card-title">Outbound</h5>
                        <p class="card-text">Kegiatan outbound seru untuk tim, keluarga, dan komunitas.</p>
                        <span class="fw-bold text-success d-block mb-3">Rp 40.000 / orang</span>
                        <button class="btn btn-success">Pesan Tiket</button>
                    </div>
                </div>
            </div>
            <!-- Paintball -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Paintball">
                    <div class="card-body text-center">
                        <h5 class="card-title">Paintball</h5>
                        <p class="card-text">Adu strategi dan kerjasama tim dalam permainan paintball seru.</p>
                        <span class="fw-bold text-success d-block mb-3">Rp 60.000 / orang</span>
                        <button class="btn btn-success">Pesan Tiket</button>
                    </div>
                </div>
            </div>
            <!-- ATV Adventure -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="ATV Adventure">
                    <div class="card-body text-center">
                        <h5 class="card-title">ATV Adventure</h5>
                        <p class="card-text">Jelajahi trek menantang dengan ATV, cocok untuk pecinta petualangan.</p>
                        <span class="fw-bold text-success d-block mb-3">Rp 70.000 / 30 menit</span>
                        <button class="btn btn-success">Pesan Tiket</button>
                    </div>
                </div>
            </div>
            <!-- Archery -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Archery">
                    <div class="card-body text-center">
                        <h5 class="card-title">Archery</h5>
                        <p class="card-text">Uji ketepatan dan konsentrasi dengan olahraga panahan di alam.</p>
                        <span class="fw-bold text-success d-block mb-3">Rp 20.000 / 20 anak panah</span>
                        <button class="btn btn-success">Pesan Tiket</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('components.footer')
@endsection
