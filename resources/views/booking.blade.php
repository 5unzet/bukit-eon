@extends('layouts.app')

@section('content')
<div class="d-flex flex-column min-vh-100 bg-light">
    @include('components.navbar')
    <main class="flex-grow-1 container py-5">
        <h1 class="text-center fw-bold mb-5">Pemesanan Makanan</h1>
        <div class="row g-4">
            <!-- Menu 1 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 text-center">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Nasi Goreng">
                    <div class="card-body">
                        <h5 class="card-title">Nasi Goreng</h5>
                        <p class="card-text">Nasi goreng spesial dengan telur dan ayam.</p>
                        <span class="fw-bold text-primary d-block mb-3">Rp 20.000</span>
                        <button class="btn btn-primary">Pesan</button>
                    </div>
                </div>
            </div>
            <!-- Menu 2 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 text-center">
                    <img src="https://images.unsplash.com/photo-1519864600265-abb23847ef2c?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Mie Goreng">
                    <div class="card-body">
                        <h5 class="card-title">Mie Goreng</h5>
                        <p class="card-text">Mie goreng lezat dengan sayuran dan bakso.</p>
                        <span class="fw-bold text-primary d-block mb-3">Rp 18.000</span>
                        <button class="btn btn-primary">Pesan</button>
                    </div>
                </div>
            </div>
            <!-- Menu 3 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 text-center">
                    <img src="https://images.unsplash.com/photo-1464306076886-debca5e8a6b0?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Ayam Bakar">
                    <div class="card-body">
                        <h5 class="card-title">Ayam Bakar</h5>
                        <p class="card-text">Ayam bakar bumbu khas Bukit Eon.</p>
                        <span class="fw-bold text-primary d-block mb-3">Rp 25.000</span>
                        <button class="btn btn-primary">Pesan</button>
                    </div>
                </div>
            </div>
            <!-- Menu 4 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 text-center">
                    <img src="https://images.unsplash.com/photo-1502741338009-cac2772e18bc?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Sate Ayam">
                    <div class="card-body">
                        <h5 class="card-title">Sate Ayam</h5>
                        <p class="card-text">Sate ayam dengan bumbu kacang khas.</p>
                        <span class="fw-bold text-primary d-block mb-3">Rp 22.000</span>
                        <button class="btn btn-primary">Pesan</button>
                    </div>
                </div>
            </div>
            <!-- Menu 5 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 text-center">
                    <img src="https://images.unsplash.com/photo-1519864600265-abb23847ef2c?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Bakso">
                    <div class="card-body">
                        <h5 class="card-title">Bakso</h5>
                        <p class="card-text">Bakso daging sapi dengan kuah gurih.</p>
                        <span class="fw-bold text-primary d-block mb-3">Rp 15.000</span>
                        <button class="btn btn-primary">Pesan</button>
                    </div>
                </div>
            </div>
            <!-- Menu 6 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 text-center">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Soto Ayam">
                    <div class="card-body">
                        <h5 class="card-title">Soto Ayam</h5>
                        <p class="card-text">Soto ayam segar dengan koya dan telur.</p>
                        <span class="fw-bold text-primary d-block mb-3">Rp 17.000</span>
                        <button class="btn btn-primary">Pesan</button>
                    </div>
                </div>
            </div>
            <!-- Menu 7 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 text-center">
                    <img src="https://images.unsplash.com/photo-1464306076886-debca5e8a6b0?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Gado-Gado">
                    <div class="card-body">
                        <h5 class="card-title">Gado-Gado</h5>
                        <p class="card-text">Gado-gado sayur segar dengan bumbu kacang.</p>
                        <span class="fw-bold text-primary d-block mb-3">Rp 16.000</span>
                        <button class="btn btn-primary">Pesan</button>
                    </div>
                </div>
            </div>
            <!-- Menu 8 -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 text-center">
                    <img src="https://images.unsplash.com/photo-1502741338009-cac2772e18bc?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Rendang">
                    <div class="card-body">
                        <h5 class="card-title">Rendang</h5>
                        <p class="card-text">Rendang daging sapi khas Padang.</p>
                        <span class="fw-bold text-primary d-block mb-3">Rp 30.000</span>
                        <button class="btn btn-primary">Pesan</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('components.footer')
</div>
@endsection
