@extends('layouts.app')

@section('content')
@php $user = session('user'); @endphp
@if($user && ($user['role_user'] ?? null) !== 'customer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'info',
                title: 'Akses Pemesanan Ditolak',
                html: 'Akun Anda adalah akun manajemen/internal.<br>Untuk melakukan pemesanan makanan, silakan gunakan akun customer.<br><br>Gunakan <b>Dashboard Management</b> untuk mengelola data dan transaksi.',
                confirmButtonText: 'Ke Dashboard',
                allowOutsideClick: false
            }).then(() => {
                window.location.href = '/dashboard';
            });
        });
    </script>
@else
<div class="d-flex flex-column min-vh-100 bg-light">
    @include('components.navbar')
    <main class="flex-grow-1 container py-5">
        <h1 class="text-center fw-bold mb-5">Pemesanan Makanan</h1>
        <form id="orderForm" autocomplete="off">
            <div class="row mb-4">
                <div class="col-md-3 mb-2">
                    <label class="form-label">No Resi</label>
                    <input type="text" class="form-control" id="resi_order" name="resi_order" value="{{ 'ORD-' . strtoupper(Str::random(8)) }}" readonly>
                </div>
                <input type="hidden" id="tanggal_order" name="tanggal_order" value="{{ now()->setTimezone('Asia/Jakarta')->format('Y-m-d') }}">
                <input type="hidden" id="waktu_order" name="waktu_order" value="{{ now('Asia/Jakarta')->format('H:i') }}">
                <div class="col-md-3 mb-2">
                    <label class="form-label">Nomor Meja</label>
                    <input type="text" class="form-control" id="meja_order" name="meja_order" placeholder="Nomor/Label Meja" required>
                </div>
            </div>
            <div class="mb-4">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalMenuMakanan">
                    <i class="bi bi-plus-circle"></i> Tambah Makanan
                </button>
            </div>
            <div id="keranjang-list">
                <!-- Daftar makanan yang dipesan akan muncul di sini -->
            </div>
            <div class="mb-3 mt-4">
                <label class="form-label">Total Semua Pesanan</label>
                <input type="text" class="form-control" id="grand_total" name="grand_total" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Pesan Makanan</button>
        </form>

        <!-- Modal Pilih Makanan -->
        <div class="modal fade" id="modalMenuMakanan" tabindex="-1" aria-labelledby="modalMenuMakananLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalMenuMakananLabel">Pilih Makanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-4">
                            @php
                                $makanans = \App\Models\Makan::where('status_makan', 'VALID')->where('ketersediaan_makan', 'OPEN')->orderBy('nama_makan')->get();
                            @endphp
                            @forelse($makanans as $makan)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card h-100 text-center">
                                    @if($makan->gambar_makan)
                                        @if(Str::startsWith($makan->gambar_makan, ['http://', 'https://']))
                                            <img src="{{ $makan->gambar_makan }}" class="card-img-top" alt="{{ $makan->nama_makan }}">
                                        @else
                                            <img src="/{{ $makan->gambar_makan }}" class="card-img-top" alt="{{ $makan->nama_makan }}">
                                        @endif
                                    @else
                                        <img src="https://placehold.co/400x300?text=No+Image" class="card-img-top" alt="{{ $makan->nama_makan }}">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $makan->nama_makan }}</h5>
                                        <p class="card-text">{{ $makan->deskripsi_makan ?? '-' }}</p>
                                        <span class="fw-bold text-primary d-block mb-3">Rp {{ number_format($makan->harga_makan,0,',','.') }}</span>
                                        <button type="button" class="btn btn-primary btnPilihMakanan" 
                                            data-id="{{ $makan->id_makan }}"
                                            data-nama="{{ $makan->nama_makan }}"
                                            data-harga="{{ $makan->harga_makan }}"
                                            data-deskripsi="{{ $makan->deskripsi_makan }}"
                                            data-gambar="{{ $makan->gambar_makan }}">
                                            Pilih
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <div class="alert alert-warning text-center">Belum ada makanan tersedia.</div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('components.footer')
    @push('scripts')
    <script>
    // Meja otomatis dari query string
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const mejaInput = document.getElementById('meja_order');
        if(urlParams.get('m')) {
            mejaInput.value = urlParams.get('m');
            mejaInput.readOnly = true;
        } else {
            mejaInput.value = '';
            mejaInput.readOnly = false;
        }

        // ...existing code...
    let keranjang = [];
    function renderKeranjang() {
        const list = document.getElementById('keranjang-list');
        list.innerHTML = '';
        let grand = 0;
        keranjang.forEach((item, idx) => {
            const subtotal = item.qty * item.harga;
            grand += subtotal;
            list.innerHTML += `
            <div class="row align-items-end mb-2 keranjang-row" data-idx="${idx}">
                <div class="col-md-3">
                    <div class="d-flex align-items-center gap-2">
                        <img src="${item.gambar ? (item.gambar.startsWith('http') ? item.gambar : '/' + item.gambar) : 'https://placehold.co/60x40?text=No+Image'}" style="width:60px;height:40px;object-fit:cover;border-radius:6px;">
                        <div>
                            <div class="fw-bold">${item.nama}</div>
                            <div class="small text-muted">${item.deskripsi||''}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control qty-input" min="1" value="${item.qty}" data-idx="${idx}">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control harga-input" value="${item.harga}" readonly>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control subtotal-input" value="${subtotal}" readonly>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control catatan-input" value="${item.catatan||''}" placeholder="Catatan (opsional)" data-idx="${idx}">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btnRemoveMakanan" data-idx="${idx}">&times;</button>
                </div>
            </div>`;
        });
        document.getElementById('grand_total').value = grand;
    }
        // Event delegation khusus tombol pilih makanan (pakai jQuery jika ada, fallback ke JS)
        document.getElementById('modalMenuMakanan').addEventListener('click', function(e) {
            let target = e.target;
            if(target.classList.contains('btnPilihMakanan')) {
                const id = target.dataset.id;
                if(keranjang.some(item => item.id == id)) {
                    Swal.fire('Sudah ada','Makanan sudah ada di keranjang!','info');
                    return;
                }
                keranjang.push({
                    id: id,
                    nama: target.dataset.nama,
                    harga: parseInt(target.dataset.harga),
                    deskripsi: target.dataset.deskripsi,
                    gambar: target.dataset.gambar,
                    qty: 1,
                    catatan: ''
                });
                renderKeranjang();
                let modalEl = document.getElementById('modalMenuMakanan');
                let modal = null;
                if(window.bootstrap && window.bootstrap.Modal && typeof window.bootstrap.Modal.getInstance === 'function') {
                    modal = window.bootstrap.Modal.getInstance(modalEl);
                }
                if(!modal && typeof $ !== 'undefined' && $(modalEl).modal) {
                    $(modalEl).modal('hide');
                } else if(modal) {
                    modal.hide();
                }
            }
        });
        // Ubah qty
        document.getElementById('keranjang-list').addEventListener('input', function(e) {
            if(e.target.classList.contains('qty-input')) {
                const idx = e.target.dataset.idx;
                keranjang[idx].qty = parseInt(e.target.value)||1;
                renderKeranjang();
            }
            if(e.target.classList.contains('catatan-input')) {
                const idx = e.target.dataset.idx;
                keranjang[idx].catatan = e.target.value;
            }
        });
        // Hapus item
        document.getElementById('keranjang-list').addEventListener('click', function(e) {
            if(e.target.classList.contains('btnRemoveMakanan')) {
                const idx = e.target.dataset.idx;
                keranjang.splice(idx,1);
                renderKeranjang();
            }
        });
        // Submit order
        document.getElementById('orderForm').onsubmit = function(e) {
            if(keranjang.length === 0) {
                e.preventDefault();
                Swal.fire('Kosong','Minimal 1 makanan harus dipesan!','warning');
                return false;
            }
            // Kirim data via AJAX dengan spinner
            e.preventDefault();
            const btn = document.querySelector('button[type="submit"]');
            const originalBtn = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memproses...';
            const data = {
                resi_order: document.getElementById('resi_order').value,
                tanggal_order: document.getElementById('tanggal_order').value,
                waktu_order: document.getElementById('waktu_order').value,
                meja_order: document.getElementById('meja_order').value,
                grand_total: document.getElementById('grand_total').value,
                makanans: keranjang.map(item => ({
                    id_makanan: item.id,
                    qty: item.qty,
                    harga: item.harga,
                    subtotal: item.qty * item.harga,
                    catatan: item.catatan
                }))
            };
            fetch('/booking', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify(data)
            })
            .then(r => r.json())
            .then(res => {
                if(res.success || res.status === 'success') {
                    Swal.fire('Berhasil','Order makanan berhasil!','success').then(()=>window.location.href='/history');
                } else {
                    btn.disabled = false;
                    btn.innerHTML = originalBtn;
                    Swal.fire('Gagal', res.message || 'Gagal order makanan','error');
                }
            })
            .catch(()=>{
                btn.disabled = false;
                btn.innerHTML = originalBtn;
                Swal.fire('Gagal','Terjadi error saat order','error');
            });
        };
    });
    </script>
    @endpush
@endif
</div>
@endsection
