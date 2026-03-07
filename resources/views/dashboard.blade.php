@extends('layouts.dashboard')

@section('dashboard-content')
<div class="container py-4">
    <h1 class="fw-bold mb-3 text-center">Dashboard</h1>
    <div class="mb-4">
        <style>
            #statistikChart {
                height: 90px;
            }
            @media (min-width: 768px) {
                #statistikChart {
                    height: 120px;
                }
            }
        </style>
        <canvas id="statistikChart"></canvas>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold text-primary">{{ $orderAktif }}</div>
                    <div class="text-muted">Order Makanan Aktif</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold text-success">{{ $tiketTerjual }}</div>
                    <div class="text-muted">Tiket Terjual Hari Ini</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold text-warning">Rp {{ number_format($nominalDidapatkan,0,',','.') }}</div>
                    <div class="text-muted">Nominal Didapatkan</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold text-info">{{ $orderSelesai }}</div>
                    <div class="text-muted">Order Makanan Selesai</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white fw-bold">Daftar Makanan yang Harus Dibuat</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Makanan</th>
                            <th>Jumlah</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($makananHarusDibuat as $i => $item)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $item->makanan->nama_makan ?? $item->nama_makan_order_detail ?? '-' }}</td>
                            <td>{{ $item->qty_order_detail }}</td>
                            <td>{{ $item->catatan_order_detail ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">Tidak ada makanan yang harus dibuat.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statistikChart').getContext('2d');
    // Data chart dari backend
    const chartData = @json($chart);
    const data = {
        labels: chartData.labels,
        datasets: [
            {
                label: 'Order Selesai',
                data: chartData.order_selesai,
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.1)',
                tension: 0.3,
                fill: true
            },
            {
                label: 'Tiket Terjual',
                data: chartData.tiket_terjual,
                borderColor: '#198754',
                backgroundColor: 'rgba(25,135,84,0.1)',
                tension: 0.3,
                fill: true
            },
            {
                label: 'Nominal (x100rb)',
                data: chartData.nominal.map(n => Math.round(n/100000)),
                borderColor: '#ffc107',
                backgroundColor: 'rgba(255,193,7,0.1)',
                tension: 0.3,
                fill: true
            }
        ]
    };
    new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Statistik 10 Hari Terakhir' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
@endsection
