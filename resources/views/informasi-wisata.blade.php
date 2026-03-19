@extends('layouts.dashboard')

@section('dashboard-content')
<div class="py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold">Informasi Wisata Bukit EON</h2>
            <p class="text-muted">Selamat datang di halaman informasi wisata. Berikut fasilitas yang tersedia dan artikel laporan terbaru dari tim kami.</p>
        </div>
    </div>

    <!-- Fasilitas -->
    <div class="row g-4 mb-5">
        @php
            $fasilitas = [
                ['icon' => 'bi bi-wifi', 'title' => 'WiFi Gratis', 'desc' => 'Akses internet cepat di seluruh area wisata.'],
                ['icon' => 'bi bi-pin-map', 'title' => 'Lokasi Strategis', 'desc' => 'Terletak di lokasi mudah dijangkau dan dekat dengan spot terbaik.'],
                ['icon' => 'bi bi-beach', 'title' => 'Area Piknik', 'desc' => 'Area piknik nyaman dengan pemandangan alam yang indah.'],
                ['icon' => 'bi bi-bicycle', 'title' => 'Sewa Sepeda', 'desc' => 'Sewa sepeda untuk keliling area wisata dengan mudah.'],
                ['icon' => 'bi bi-cup-straw', 'title' => 'Cafe & Resto', 'desc' => 'Nikmati aneka minuman dan makanan di cafe & resto kami.'],
                ['icon' => 'bi bi-people-fill', 'title' => 'Area Keluarga', 'desc' => 'Area bermain dan bersantai untuk keluarga dan anak-anak.'],
            ];
        @endphp

        @foreach($fasilitas as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="{{ $item['icon'] }}" style="font-size: 1.25rem;"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1">{{ $item['title'] }}</h5>
                                <p class="card-text text-muted small mb-0">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Artikel / Laporan Wisata -->
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3 class="fw-bold mb-0">Artikel &amp; Laporan</h3>
            <a href="/dashboard/laporan/wisata" class="btn btn-outline-primary btn-sm">Kelola Laporan (Admin)</a>
        </div>
    </div>

    @if($laporans->count() > 0)
        <div class="row g-4">
            @foreach($laporans as $laporan)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if($laporan->foto_laporan)
                            <div style="height: 200px; overflow: hidden;">
                                @if(Str::startsWith($laporan->foto_laporan, ['http://', 'https://']))
                                    <img src="{{ $laporan->foto_laporan }}" class="w-100" style="height:100%;object-fit:cover;" alt="{{ $laporan->judul_laporan }}">
                                @else
                                    <img src="/{{ $laporan->foto_laporan }}" class="w-100" style="height:100%;object-fit:cover;" alt="{{ $laporan->judul_laporan }}">
                                @endif
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $laporan->judul_laporan }}</h5>
                            <p class="card-text text-muted mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $laporan->keterangan_laporan }}
                            </p>
                            <div class="mt-auto">
                                <small class="text-muted">
                                    <i class="bi bi-calendar-event me-1"></i>{{ date('d M Y', strtotime($laporan->updated_at_laporan ?? $laporan->created_at_laporan)) }}
                                </small>
                                @if($laporan->user)
                                    <small class="text-muted ms-2">
                                        <i class="bi bi-person me-1"></i>{{ $laporan->user->nama_user }}
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>Tidak ada artikel atau laporan untuk ditampilkan saat ini.
        </div>
    @endif
</div>
@endsection
