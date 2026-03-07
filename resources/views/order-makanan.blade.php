@extends('layouts.dashboard')

@section('dashboard-content')
<div class="py-4">
    <h2 class="fw-bold mb-3">Order Makanan</h2>
    <form method="get" class="mb-3 d-flex align-items-center gap-2" id="filterTanggalForm">
        <label class="form-label mb-0">Tanggal:</label>
        <input type="date" name="tanggal" class="form-control" id="filterTanggal" style="width:200px" value="{{ $tanggal ?? (now()->setTimezone('Asia/Jakarta')->format('Y-m-d')) }}" onchange="this.form.submit()">
    </form>
    <div class="table-responsive">
        <table class="table table-bordered align-middle" id="orderTable">
            <thead class="table-light">
                <tr>
                    <th></th>
                    <th>No Resi</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Nama Konsumen</th>
                    <th>No Meja</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="orderTbody">
                @foreach($orders as $idx => $order)
                <tr>
                    <td>
                        <button class="btn btn-sm btn-link" type="button" onclick="document.getElementById('detail-{{ $idx }}').classList.toggle('d-none')">
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </td>
                    <td>{{ $order->resi_order_header }}</td>
                    <td>{{ $order->tanggal_order_header }}</td>
                    <td>{{ $order->waktu_order_header }}</td>
                    <td>{{ $order->nama_order_header }}</td>
                    <td>{{ $order->meja_order_header }}</td>
                    <td><span class="badge bg-{{ strtolower($order->status_order_header) == 'input' ? 'secondary' : (strtolower($order->status_order_header) == 'valid' ? 'info' : (strtolower($order->status_order_header) == 'finish' ? 'warning' : (strtolower($order->status_order_header) == 'paid' ? 'success' : 'danger'))) }} text-dark text-capitalize">{{ strtolower($order->status_order_header) }}</span></td>
                    <td>Rp {{ number_format($order->total_order_header,0,',','.') }}</td>
                    <td>
                        @if(strtolower($order->status_order_header) === 'input')
                        <button class="btn btn-sm btn-primary btn-validasi" data-id="{{ $order->id_order_header }}">Validasi</button>
                        @endif
                        @if(strtolower($order->status_order_header) === 'finish')
                        <button class="btn btn-sm btn-success btn-bayar" data-id="{{ $order->id_order_header }}" data-total="{{ $order->total_order_header }}">Bayar</button>
                        @endif
                        @php $isPaid = strtolower($order->status_order_header) === 'paid'; @endphp
                        <button class="btn btn-sm btn-danger btn-void-order" data-id="{{ $order->id_order_header }}" disabled>Void</button>
                    </td>
                </tr>
                <tr class="order-detail d-none" id="detail-{{ $idx }}">
                    <td colspan="9">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Menu</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Catatan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->details as $item)
                                    <tr>
                                        <td>{{ $item->nama_makan_order_detail }}</td>
                                        <td>{{ $item->qty_order_detail }}</td>
                                        <td>Rp {{ number_format($item->harga_order_detail,0,',','.') }}</td>
                                        <td>{{ $item->catatan_order_detail ?: '-' }}</td>
                                        <td><span class="badge bg-{{ strtolower($item->status_order_detail) == 'finish' ? 'success' : (strtolower($item->status_order_detail) == 'void' ? 'danger' : 'secondary') }} text-dark text-capitalize">{{ strtolower($item->status_order_detail) }}</span></td>
                                        <td>
                                            @if(strtolower($order->status_order_header) === 'valid' && !in_array(strtolower($item->status_order_detail), ['finish','void']))
                                            <button class="btn btn-sm btn-outline-success btn-finish-item" data-id="{{ $item->id_order_detail }}">Finish</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Bayar -->
    <div class="modal fade" id="modalBayar" tabindex="-1" aria-labelledby="modalBayarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBayarLabel">Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formBayar">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label">Tagihan</label>
                            <input type="text" class="form-control" id="bayarTagihan" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Nominal Bayar</label>
                            <input type="number" class="form-control" id="bayarNominal" min="0" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Kembalian</label>
                            <input type="text" class="form-control" id="bayarKembalian" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--<div class="alert alert-warning mb-4">
    <strong>Catatan Rules Order Makanan:</strong>
    <ul class="mb-0">
        <li>Urutan status resi: <b>input</b> → <b>valid</b> (manual) → <b>finish</b> (otomatis jika semua makanan finish) → <b>paid</b> (manual, input nominal bayar) → <b>void</b>.</li>
        <li>Resi status <b>input</b>: hanya tombol Validasi aktif, item makanan belum bisa di-finish.</li>
        <li>Resi status <b>valid</b>: item makanan bisa di-finish satu per satu, status resi otomatis jadi <b>finish</b> jika semua item sudah finish.</li>
        <li>Resi status <b>finish</b>: tombol Bayar aktif, input nominal bayar, tampil tagihan, bayar, kembalian.</li>
        <li>Resi status <b>paid</b>: semua aksi nonaktif, hanya tombol Void yang disable.</li>
        <li>Resi status <b>void</b>: semua item makanan otomatis status void, tidak bisa diapa-apakan.</li>
        <li>Tombol Void/Hapus selalu tampil, disable jika status paid.</li>
        <li>Catatan makanan boleh kosong.</li>
        <li>Nama konsumen dan nomor meja wajib diisi.</li>
        <li>Filter tanggal di atas, default hari ini.</li>
        <li>Data dummy, semua aksi hanya update di JS.</li>
    </ul>
</div>-->

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-validasi').forEach(function(btn) {
        btn.addEventListener('click', function() {
            Swal.fire({
                title: 'Validasi order ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Validasi',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(!result.isConfirmed) return;
            fetch("{{ route('dashboard.order-makanan.validasi') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({ id: this.dataset.id })
            })
            .then(res => res.json())
            .then(res => {
                if(res.success) {
                    Swal.fire('Berhasil', 'Order divalidasi!', 'success').then(()=>location.reload());
                } else {
                    Swal.fire('Gagal', res.message || 'Gagal validasi!', 'error');
                }
            })
            .catch(()=>Swal.fire('Gagal', 'Gagal validasi!', 'error'));
        });
        });
    });
    document.querySelectorAll('.btn-finish-item').forEach(function(btn) {
        btn.addEventListener('click', function() {
            Swal.fire({
                title: 'Tandai item ini sudah finish?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Finish',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(!result.isConfirmed) return;
            fetch("{{ route('dashboard.order-makanan.finish-item') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({ id: this.dataset.id })
            })
            .then(res => res.json())
            .then(res => {
                if(res.success) {
                    Swal.fire('Berhasil', 'Item sudah finish!', 'success').then(()=>location.reload());
                } else {
                    Swal.fire('Gagal', res.message || 'Gagal update status!', 'error');
                }
            })
            .catch(()=>Swal.fire('Gagal', 'Gagal update status!', 'error'));
        });
    });
    });
    document.querySelectorAll('.btn-bayar').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const orderId = this.dataset.id;
            const total = parseInt(this.dataset.total);
            document.getElementById('bayarTagihan').value = 'Rp ' + total.toLocaleString();
            document.getElementById('bayarNominal').value = '';
            document.getElementById('bayarKembalian').value = '';
            const form = document.getElementById('formBayar');
            form.onsubmit = function(e) {
                e.preventDefault();
                const bayar = parseInt(document.getElementById('bayarNominal').value||'0');
                if(bayar < total) {
                    Swal.fire('Gagal', 'Nominal bayar kurang dari tagihan!', 'error');
                    return;
                }
                document.getElementById('bayarKembalian').value = 'Rp ' + (bayar-total).toLocaleString();
                fetch("{{ route('dashboard.order-makanan.bayar') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify({ id: orderId, nominal: bayar })
                })
                .then(res => res.json())
                .then(res => {
                    if(res.success) {
                        bootstrap.Modal.getInstance(document.getElementById('modalBayar')).hide();
                        Swal.fire('Berhasil', 'Pembayaran sukses!', 'success').then(()=>location.reload());
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal bayar!', 'error');
                    }
                })
                .catch(()=>Swal.fire('Gagal', 'Gagal bayar!', 'error'));
            };
            new bootstrap.Modal(document.getElementById('modalBayar')).show();
        });
    });

    document.querySelectorAll('.btn-void-order').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if(this.disabled) return;
            Swal.fire({
                title: 'Yakin void/hapus order ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Void',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(!result.isConfirmed) return;
                fetch("{{ route('dashboard.order-makanan.void') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify({ id: this.dataset.id })
                })
                .then(res => res.json())
                .then(res => {
                    if(res.success) {
                        Swal.fire('Berhasil', 'Order berhasil di-void!', 'success').then(()=>location.reload());
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal void!', 'error');
                    }
                })
                .catch(()=>Swal.fire('Gagal', 'Gagal void!', 'error'));
            });
        });
    });
});
</script>
@endpush
@endsection
