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
                    height: 200px;
                }
            }
        </style>
        <canvas id="statistikChart"></canvas>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold text-primary">8</div>
                    <div class="text-muted">Order Makanan Aktif</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold text-success">27</div>
                    <div class="text-muted">Tiket Terjual Hari Ini</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold text-warning">Rp 1.250.000</div>
                    <div class="text-muted">Nominal Didapatkan</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold text-info">15</div>
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
                        <tr>
                            <td>1</td>
                            <td>Nasi Goreng Spesial</td>
                            <td>3</td>
                            <td>Tanpa cabe</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Mie Ayam Bakso</td>
                            <td>2</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Sate Ayam</td>
                            <td>5</td>
                            <td>Tambah lontong</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Es Teh Manis</td>
                            <td>4</td>
                            <td>Es terpisah</td>
                        </tr>
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
    // Generate 7 tanggal ke belakang mulai dari kemarin
    function getLast7DaysLabels() {
        const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const labels = [];
        const today = new Date();
        for (let i = 7; i >= 1; i--) {
            const d = new Date(today);
            d.setDate(today.getDate() - i);
            labels.push(d.getDate() + ' ' + monthNames[d.getMonth()]);
        }
        return labels;
    }
    const labels = getLast7DaysLabels();
    const data = {
        labels: labels,
        datasets: [
            {
                label: 'Order Selesai',
                data: [7, 8, 6, 10, 9, 12, 11, 13, 8, 15],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.1)',
                tension: 0.3,
                fill: true
            },
            {
                label: 'Tiket Terjual',
                data: [20, 22, 18, 25, 24, 27, 23, 29, 21, 27],
                borderColor: '#198754',
                backgroundColor: 'rgba(25,135,84,0.1)',
                tension: 0.3,
                fill: true
            },
            {
                label: 'Nominal (x100rb)',
                data: [9, 10, 8, 12, 11, 13, 12, 14, 10, 15],
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
