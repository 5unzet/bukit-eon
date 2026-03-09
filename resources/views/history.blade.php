@extends('layouts.app')

@section('content')
@php $user = session('user'); @endphp
@include('components.navbar')
<main class="bg-light py-5 min-vh-100">
    <div class="container">
        <h1 class="text-center fw-bold mb-5">Riwayat Pesanan Tiket</h1>
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form method="get" id="filterForm" class="d-flex align-items-end gap-2">
                    <div>
                        <label class="form-label mb-1">Bulan</label>
                        <select name="bulan" id="filter_bulan" class="form-select">
                            @for($b=1;$b<=12;$b++)
                                <option value="{{ $b }}" {{ (request('bulan', now()->month) == $b) ? 'selected' : '' }}>{{ sprintf('%02d', $b) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="form-label mb-1">Tahun</label>
                        <select name="tahun" id="filter_tahun" class="form-select">
                            @for($y = now()->year; $y >= now()->year-5; $y--)
                                <option value="{{ $y }}" {{ request('tahun', now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm mb-5">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Resi</th>
                                        <th>Wisata</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Tiket</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $order->resi_tiket }}</td>
                                        <td>{{ $order->judul_iw ?? '-' }}</td>
                                        <td>{{ $order->tanggal_tiket }}</td>
                                        <td>{{ $order->qty_tiket }}</td>
                                        <td>Rp {{ number_format($order->total_tiket,0,',','.') }}</td>
                                        <td>
                                            @if($order->status_tiket === 'VALID')
                                                <button type="button" class="btn btn-sm btn-success ms-2" onclick="gotoPembayaran('{{ $order->resi_tiket }}')">Bayar</button>
                                                <button type="button" class="btn btn-sm btn-danger ms-2" onclick="voidPesanan('{{ $order->resi_tiket }}')">Batal</button>
                                            @elseif($order->status_tiket === 'PAID')
                                                <button type="button" class="btn btn-sm btn-secondary ms-2" disabled>Paid</button>
                                            @else
                                                <span class="badge bg-warning text-dark ms-2">{{ $order->status_tiket }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="6" class="text-center text-muted">Belum ada pesanan tiket.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Tabel Riwayat Pesanan Makanan -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="fw-bold mb-4 text-center">Riwayat Pesanan Makanan</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>Resi</th>
                                        <th>Tanggal</th>
                                        <th>Meja</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($makanan_orders as $order)
                                    <tr>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary btn-expand-makanan" data-resi="{{ $order->resi_order_header }}">
                                                <span class="expand-icon" id="icon-{{ $order->resi_order_header }}">&#x25BC;</span>
                                            </button>
                                        </td>
                                        <td>{{ $order->resi_order_header }}</td>
                                        <td>{{ $order->tanggal_order_header }}</td>
                                        <td>{{ $order->meja_order_header }}</td>
                                        <td>Rp {{ number_format($order->total_order_header,0,',','.') }}</td>
                                        <td><span class="badge bg-info text-dark">{{ $order->status_order_header }}</span></td>
                                    </tr>
                                    <tr id="detail-{{ $order->resi_order_header }}" class="d-none bg-light">
                                        <td colspan="6">
                                            <div class="p-2">
                                                <table class="table table-sm table-bordered mt-2">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>Qty</th>
                                                            <th>Harga</th>
                                                            <th>Subtotal</th>
                                                            <th>Catatan</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $details = DB::table('tbl_order_detail')
                                                            ->where('resi_order_detail', $order->resi_order_header)
                                                            ->get();
                                                        @endphp
                                                        @foreach($details as $d)
                                                        <tr>
                                                            <td>{{ $d->nama_makan_order_detail }}</td>
                                                            <td>{{ $d->qty_order_detail }}</td>
                                                            <td>Rp {{ number_format($d->harga_order_detail,0,',','.') }}</td>
                                                            <td>Rp {{ number_format($d->qty_order_detail * $d->harga_order_detail,0,',','.') }}</td>
                                                            <td>{{ $d->catatan_order_detail ?? '-' }}</td>
                                                            <td>
                                                                <span class="badge bg-secondary">{{ $d->status_order_detail }}</span>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="6" class="text-center text-muted">Belum ada pesanan makanan.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
function gotoPembayaran(resi) {
    sessionStorage.setItem('pemesanan_tiket_resi', resi);
    window.location.href = '/ticketing/payment';
}
function voidPesanan(resi) {
    Swal.fire({
        icon: 'warning',
        title: 'Batalkan Pesanan?',
        text: 'Pesanan yang dibatalkan tidak dapat dikembalikan. Lanjutkan?',
        showCancelButton: true,
        confirmButtonText: 'Ya, Batalkan',
        cancelButtonText: 'Tidak',
        confirmButtonColor: '#d33',
    }).then((result) => {
        if(result.isConfirmed) {
            fetch('/ticketing/void', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ resi: resi })
            })
            .then(resp => resp.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({ icon: 'success', title: 'Dibatalkan', text: 'Pesanan berhasil dibatalkan.' }).then(()=>window.location.reload());
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Gagal membatalkan pesanan.' });
                }
            })
            .catch(()=>{
                Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan.' });
            });
        }
    });
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-expand-makanan').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const resi = btn.dataset.resi;
            const detailRow = document.getElementById('detail-' + resi);
            const icon = document.getElementById('icon-' + resi);
            if(detailRow.classList.contains('d-none')) {
                detailRow.classList.remove('d-none');
                icon.innerHTML = '&#x25B2;'; // up arrow
            } else {
                detailRow.classList.add('d-none');
                icon.innerHTML = '&#x25BC;'; // down arrow
            }
        });
    });
});
</script>
@endsection
