@extends('layouts.dashboard')

@section('dashboard-content')
<div class="py-4">
    <h2 class="fw-bold mb-3">Manajemen Tiket Wisata</h2>
    <form method="get" class="mb-3 d-flex align-items-center gap-2" id="filterTanggalForm">
        <label class="form-label mb-0">Tanggal:</label>
        <input type="date" name="tanggal" class="form-control" id="filterTanggal" style="width:200px" value="{{ $tanggal ?? (now()->setTimezone('Asia/Jakarta')->format('Y-m-d')) }}" onchange="this.form.submit()">
    </form>
    <div class="table-responsive">
        <table class="table table-bordered align-middle" id="tiketTable">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>No Tiket</th>
                    <th>Tanggal</th>
                    <th>Wisata</th>
                    <th>Customer</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>PICC</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tiketTbody">
                @foreach($tikets as $idx => $tiket)
                <tr>
                    <td>{{ $idx+1 }}</td>
                    <td>{{ $tiket->resi_tiket }}</td>
                    <td>{{ date('Y-m-d', strtotime($tiket->created_tiket)) }}</td>
                    <td>{{ $tiket->iw ? $tiket->iw->judul_iw : '-' }}</td>
                    <td>{{ $tiket->cust ? $tiket->cust->nama_cust : '-' }}</td>
                    <td>{{ $tiket->qty_tiket }}</td>
                    <td>Rp {{ number_format($tiket->total_tiket,0,',','.') }}</td>
                    <td>{{ $tiket->piccUser ? $tiket->piccUser->nama_user : '-' }}</td>
                    <td>{{ $tiket->created_tiket ? date('Y-m-d H:i', strtotime($tiket->created_tiket)) : '-' }}</td>
                    <td><span class="badge bg-{{ strtolower($tiket->status_tiket) == 'input' ? 'secondary' : (strtolower($tiket->status_tiket) == 'valid' ? 'info' : (strtolower($tiket->status_tiket) == 'paid' ? 'success' : 'danger')) }} text-dark text-capitalize">{{ strtolower($tiket->status_tiket) }}</span></td>
                    <td>
                        @if(strtolower($tiket->status_tiket) === 'input')
                        <button class="btn btn-sm btn-primary btn-validasi" data-id="{{ $tiket->id_tiket }}">Validasi</button>
                        @endif
                        @if(strtolower($tiket->status_tiket) === 'valid')
                        <button class="btn btn-sm btn-success btn-bayar" data-id="{{ $tiket->id_tiket }}">Bayar</button>
                        @endif
                        @if(strtolower($tiket->status_tiket) !== 'void')
                        <button class="btn btn-sm btn-danger btn-void-tiket" data-id="{{ $tiket->id_tiket }}" @if(strtolower($tiket->status_tiket)==='paid') disabled @endif>Void</button>
                        <a href="{{ route('dashboard.tiket.cetak', $tiket->id_tiket) }}" class="btn btn-sm btn-outline-secondary" target="_blank">Cetak</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-validasi').forEach(function(btn) {
        btn.addEventListener('click', function() {
            Swal.fire({
                title: 'Validasi tiket ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Validasi',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(!result.isConfirmed) return;
                fetch("{{ route('dashboard.tiket.validasi') }}", {
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
                        Swal.fire('Berhasil', 'Tiket divalidasi!', 'success').then(()=>location.reload());
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal validasi!', 'error');
                    }
                })
                .catch(()=>Swal.fire('Gagal', 'Gagal validasi!', 'error'));
            });
        });
    });
    document.querySelectorAll('.btn-bayar').forEach(function(btn) {
        btn.addEventListener('click', function() {
            Swal.fire({
                title: 'Konfirmasi pembayaran tiket ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sudah Dibayar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(!result.isConfirmed) return;
                fetch("{{ route('dashboard.tiket.bayar') }}", {
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
                        Swal.fire('Berhasil', 'Tiket sudah dibayar!', 'success').then(()=>location.reload());
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal bayar!', 'error');
                    }
                })
                .catch(()=>Swal.fire('Gagal', 'Gagal bayar!', 'error'));
            });
        });
    });
    document.querySelectorAll('.btn-void-tiket').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if(this.disabled) return;
            Swal.fire({
                title: 'Yakin void/hapus tiket ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Void',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(!result.isConfirmed) return;
                fetch("{{ route('dashboard.tiket.void') }}", {
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
                        Swal.fire('Berhasil', 'Tiket berhasil di-void!', 'success').then(()=>location.reload());
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
