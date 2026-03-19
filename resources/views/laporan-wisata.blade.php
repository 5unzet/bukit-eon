@extends('layouts.dashboard')

@section('dashboard-content')
<div class="py-4">
    <h2 class="fw-bold mb-3">Manajemen Laporan Wisata</h2>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0">Kelola laporan, ulasan, dan artikel tentang wisata di Bukit EON.</p>
        <a href="/dashboard/laporan/wisata/form" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Tambah Laporan
        </a>
    </div>

    @if($laporans->count() > 0)
    <div class="row g-4">
        @forelse($laporans as $laporan)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 overflow-hidden">
                <!-- Foto -->
                @if($laporan->foto_laporan)
                    <div style="height: 200px; overflow: hidden; background: #e9ecef;">
                        @if(Str::startsWith($laporan->foto_laporan, ['http://', 'https://']))
                            <img src="{{ $laporan->foto_laporan }}" alt="{{ $laporan->judul_laporan }}" 
                                style="width:100%;height:100%;object-fit:cover;">
                        @else
                            <img src="/{{ $laporan->foto_laporan }}" alt="{{ $laporan->judul_laporan }}" 
                                style="width:100%;height:100%;object-fit:cover;">
                        @endif
                    </div>
                @else
                    <div style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                    </div>
                @endif

                <!-- Content -->
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold text-truncate" title="{{ $laporan->judul_laporan }}">
                        {{ $laporan->judul_laporan }}
                    </h5>
                    
                    <p class="card-text text-muted small flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        {{ $laporan->keterangan_laporan }}
                    </p>

                    <div class="border-top pt-2 mt-2">
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-person me-1"></i>{{ $laporan->user->nama_user ?? '-' }}
                        </small>
                        <small class="text-muted d-block">
                            <i class="bi bi-calendar me-1"></i>{{ date('d M Y', strtotime($laporan->updated_at_laporan ?? $laporan->created_at_laporan)) }}
                        </small>
                    </div>

                    <div class="btn-group w-100 mt-3" role="group">
                        <a href="/dashboard/laporan/wisata/form/{{ $laporan->id_laporan }}" 
                            class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger" 
                            onclick="hapusLaporan({{ $laporan->id_laporan }})">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>Belum ada laporan wisata. <a href="/dashboard/laporan/wisata/form">Tambah laporan baru</a>
            </div>
        </div>
        @endforelse
    </div>
    @else
    <div class="card shadow-sm border-0">
        <div class="card-body text-center py-5">
            <i class="bi bi-file-text" style="font-size: 3rem; color: #ccc;"></i>
            <h5 class="mt-3 text-muted">Belum Ada Laporan Wisata</h5>
            <p class="text-muted mb-3">Mulai buat laporan wisata pertama Anda untuk berbagi informasi dan ulasan.</p>
            <a href="/dashboard/laporan/wisata/form" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Buat Laporan Pertama
            </a>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function getCsrfToken() {
        return document.querySelector('meta[name=csrf-token]')?.content || '';
    }

    function hapusLaporan(id) {
        Swal.fire({
            title: 'Hapus Laporan Wisata?',
            text: 'Data laporan akan dihapus dan tidak bisa dipulihkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/dashboard/laporan/wisata/hapus/${id}`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': getCsrfToken() },
                })
                .then(r => r.json())
                .then(res => {
                    if(res.success) {
                        Swal.fire('Terhapus!', 'Laporan wisata berhasil dihapus.', 'success')
                            .then(() => location.reload());
                    } else {
                        Swal.fire('Gagal!', res.message || 'Terjadi kesalahan', 'error');
                    }
                })
                .catch(err => {
                    Swal.fire('Gagal!', err.message, 'error');
                });
            }
        });
    }
</script>
@endpush
@endsection
