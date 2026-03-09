@extends('layouts.app')

@section('content')
@php $user = session('user'); @endphp
@if($user && ($user['role_user'] ?? null) !== 'customer')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'info',
                title: 'Akses Pemesanan Ditolak',
                html: 'Akun Anda adalah akun manajemen/internal.<br>Untuk melakukan pemesanan tiket wisata, silakan gunakan akun customer.<br><br>Gunakan <b>Dashboard Management</b> untuk mengelola data dan transaksi.',
                confirmButtonText: 'Ke Dashboard',
                allowOutsideClick: false
            }).then(() => {
                window.location.href = '/dashboard';
            });
        });
    </script>
@else
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .wisata-card-img {
        height: 220px;
        object-fit: cover;
        width: 100%;
        border-top-left-radius: .5rem;
        border-top-right-radius: .5rem;
    }
    .wisata-card {
        min-height: 420px;
        display: flex;
        flex-direction: column;
    }
    .wisata-card .card-body {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }
</style>
@include('components.navbar')

<main class="bg-light py-5 min-vh-100">
    <div class="container">
        <h1 class="text-center fw-bold mb-5">Pemesanan Tiket Wisata</h1>
        <div class="row g-4">
            @foreach($wisatas as $iw)
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                <div class="card wisata-card h-100 shadow-sm border-0">
                    <img src="{{ $iw->foto_iw ? (Str::startsWith($iw->foto_iw, ['http://','https://']) ? $iw->foto_iw : asset($iw->foto_iw)) : 'https://via.placeholder.com/600x400?text=Wisata' }}" class="wisata-card-img" alt="{{ $iw->judul_iw }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $iw->judul_iw }}</h5>
                        <p class="card-text">{{ $iw->deskripsi_iw }}</p>
                        <span class="fw-bold text-success d-block mb-3">Rp {{ number_format($iw->tiket_iw,0,',','.') }}</span>
                        <button class="btn btn-success" onclick="showPesanTiketModal({{ $iw->id_iw }}, '{{ addslashes($iw->judul_iw) }}', {{ $iw->tiket_iw }})">Pesan Tiket</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Modal Pemesanan Tiket -->
        <div class="modal fade" id="modalPesanTiket" tabindex="-1" aria-labelledby="modalPesanTiketLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPesanTiketLabel">Pesan Tiket Wisata</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formPesanTiket" autocomplete="off">
                        <div class="modal-body">
                            <input type="hidden" name="id_iw" id="modal_id_iw">
                            <input type="hidden" name="judul_iw" id="modal_judul_iw">
                            <input type="hidden" name="harga_tiket" id="modal_harga_tiket">
                            <input type="hidden" name="resi_tiket" id="modal_resi_tiket">
                            <div class="mb-3">
                                <label class="form-label">Wisata</label>
                                <input type="text" class="form-control" id="modal_nama_wisata" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Kunjungan</label>
                                <input type="date" class="form-control" name="tanggal" id="modal_tanggal" required value="{{ now()->setTimezone('Asia/Jakarta')->format('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Tiket</label>
                                <input type="text" class="form-control" id="modal_harga_tiket_view" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah Tiket</label>
                                <input type="number" class="form-control" name="qty" id="modal_qty" min="1" value="1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Total Harga</label>
                                <input type="text" class="form-control" id="modal_total_harga" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Lanjut Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
        function generateResiTiket() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let resi = 'TKT-';
            for (let i = 0; i < 8; i++) {
                resi += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return resi;
        }
        function showPesanTiketModal(id, judul, harga) {
            document.getElementById('modal_id_iw').value = id;
            document.getElementById('modal_judul_iw').value = judul;
            document.getElementById('modal_nama_wisata').value = judul;
            document.getElementById('modal_harga_tiket').value = harga;
            document.getElementById('modal_harga_tiket_view').value = 'Rp ' + Number(harga).toLocaleString();
            document.getElementById('modal_qty').value = 1;
            document.getElementById('modal_total_harga').value = 'Rp ' + Number(harga).toLocaleString();
            document.getElementById('modal_resi_tiket').value = generateResiTiket();
            var modal = new bootstrap.Modal(document.getElementById('modalPesanTiket'));
            modal.show();
        }
        document.addEventListener('DOMContentLoaded', function() {
            const qtyInput = document.getElementById('modal_qty');
            if(qtyInput) {
                qtyInput.addEventListener('input', function() {
                    const harga = parseInt(document.getElementById('modal_harga_tiket').value || 0);
                    const qty = parseInt(this.value || 0);
                    document.getElementById('modal_total_harga').value = 'Rp ' + (harga * qty).toLocaleString();
                });
            }
            const form = document.getElementById('formPesanTiket');
            if(form) {
                form.onsubmit = async function(e) {
                    e.preventDefault();
                    // Ambil angka murni untuk harga dan total
                    function parseRupiah(str) {
                        if (!str) return 0;
                        return parseInt(String(str).replace(/[^\d]/g, '')) || 0;
                    }
                    const data = {
                        id_iw: document.getElementById('modal_id_iw').value,
                        judul_iw: document.getElementById('modal_judul_iw').value,
                        harga_tiket: parseRupiah(document.getElementById('modal_harga_tiket').value),
                        qty: parseInt(document.getElementById('modal_qty').value),
                        tanggal: document.getElementById('modal_tanggal').value,
                        total_harga: parseRupiah(document.getElementById('modal_total_harga').value),
                        resi_tiket: document.getElementById('modal_resi_tiket').value
                    };
                    try {
                        const resp = await fetch('/ticketing/order', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(data)
                        });
                        if (!resp.ok) throw new Error('Gagal menyimpan pesanan');
                        const result = await resp.json();
                        // Simpan hanya resi_tiket (atau id pesanan jika ada) ke sessionStorage
                        sessionStorage.setItem('pemesanan_tiket_resi', data.resi_tiket);
                        window.location.href = '/ticketing/payment';
                    } catch (err) {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: err.message });
                    }
                }
            }
        });
        </script>
    </div>
</main>

@include('components.footer')
@endsection
@endif
