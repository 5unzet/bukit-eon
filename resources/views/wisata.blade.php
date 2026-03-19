@extends('layouts.dashboard')

@section('dashboard-content')
<div class="py-4">
    <h2 class="fw-bold mb-3">Manajemen Wisata</h2>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0">Kelola daftar wisata, tiket, dan aktivitas di Bukit EON.</p>
        <a href="/dashboard/wisata/form" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Tambah Wisata</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Foto</th>
                    <th style="width:30%">Deskripsi</th>
                    <th>Buka</th>
                    <th>Tutup</th>
                    <th>Tiket</th>
                    <th>PIC</th>
                    <th>Updated</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wisatas as $iw)
                <tr>
                    <td>{{ $iw->id_iw }}</td>
                    <td>{{ $iw->judul_iw }}</td>
                    <td>
                        @if($iw->foto_iw)
                            @if(Str::startsWith($iw->foto_iw, ['http://', 'https://']))
                                <img src="{{ $iw->foto_iw }}" alt="{{ $iw->judul_iw }}" style="height:40px;width:40px;object-fit:cover;border-radius:6px;">
                            @else
                                <img src="/{{ $iw->foto_iw }}" alt="{{ $iw->judul_iw }}" style="height:40px;width:40px;object-fit:cover;border-radius:6px;">
                            @endif
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td style="width:30%">{{ $iw->deskripsi_iw }}</td>
                    <td>{{ $iw->buka_iw ? substr($iw->buka_iw,0,5) : '-' }}</td>
                    <td>{{ $iw->tutup_iw ? substr($iw->tutup_iw,0,5) : '-' }}</td>
                    <td>{{ ($iw->tiket_iw ?? 0) == 0 ? 'Free' : 'Rp '.number_format($iw->tiket_iw,0,',','.') }}</td>
                    <td>{{ $iw->user->nama_user ?? '-' }}</td>
                    <td>{{ $iw->updated_at_iw }}</td>
                    <td>
                        <a href="/dashboard/wisata/form/{{ $iw->id_iw }}" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></a>
                        <button class="btn btn-sm btn-outline-danger" onclick="hapusIw({{ $iw->id_iw }})"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">Belum ada data wisata.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>



@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function getCsrfToken() {
        var meta = document.querySelector('meta[name=csrf-token]');
        return meta ? meta.content : '';
    }
    
    function hapusIw(id) {
        Swal.fire({
            title: 'Hapus Wisata?',
            text: 'Data wisata akan dihapus (status VOID)!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/dashboard/wisata/hapus/${id}`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': getCsrfToken() },
                })
                .then(r => r.json())
                .then(res => {
                    if(res.success) {
                        Swal.fire('Terhapus!', 'Data wisata berhasil dihapus.', 'success').then(() => location.reload());
                    }
                });
            }
        });
    }
</script>
@endpush
@endsection
