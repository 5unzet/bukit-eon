@extends('layouts.dashboard')

@section('dashboard-content')
<div class="py-4">
    <h2 class="fw-bold mb-3">Manajemen Wisata</h2>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0">Kelola daftar wisata, tiket, dan aktivitas di Bukit EON.</p>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahIw"><i class="bi bi-plus-circle me-1"></i>Tambah Wisata</button>
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
                        <button class="btn btn-sm btn-outline-warning me-1" onclick="editIw({{ $iw->id_iw }})"><i class="bi bi-pencil"></i></button>
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

    <!-- Modal Tambah/Edit Wisata -->
    <div class="modal fade" id="modalTambahIw" tabindex="-1" aria-labelledby="modalTambahIwLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahIwLabel">Tambah/Edit Wisata</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formIw">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Judul Wisata</label>
                                <input type="text" class="form-control" name="judul_iw" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tiket Masuk</label>
                                <input type="number" class="form-control" name="tiket_iw" value="0">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi_iw" rows="2"></textarea>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jam Buka</label>
                                <input type="time" class="form-control" name="buka_iw">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jam Tutup</label>
                                <input type="time" class="form-control" name="tutup_iw">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Foto</label>
                                <input type="file" class="form-control" name="foto_iw" accept="image/*" onchange="window.previewFotoIw(event)">
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="w-100">
                                    <label class="form-label">Preview</label>
                                    <div class="border rounded p-2 text-center bg-light">
                                        <img id="previewFotoIw" src="data:image/svg+xml,%3Csvg width='120' height='80' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='120' height='80' fill='%23e9ecef'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-size='14' fill='%236c757d'%3EPreview%3C/text%3E%3C/svg%3E" style="max-width:120px;max-height:80px;object-fit:cover;" alt="Preview Foto">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.wisatas = (@json($wisatas)).map(function(iw) {
        return {
            id_iw: iw.id_iw,
            judul_iw: iw.judul_iw,
            tiket_iw: iw.tiket_iw,
            deskripsi_iw: iw.deskripsi_iw,
            buka_iw: iw.buka_iw,
            tutup_iw: iw.tutup_iw,
            foto_iw: iw.foto_iw
        };
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let idEditIw = null;
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
    window.previewFotoIw = function(event) {
        const input = event.target;
        const preview = document.getElementById('previewFotoIw');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "data:image/svg+xml,%3Csvg width='120' height='80' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='120' height='80' fill='%23e9ecef'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-size='14' fill='%236c757d'%3EPreview%3C/text%3E%3C/svg%3E";
        }
    }
    window.editIw = function(id) {
        idEditIw = id;
        var data = (window.wisatas || []).find(function(iw) { return iw.id_iw == id });
        if(!data) return;
        document.querySelector('#formIw [name="judul_iw"]').value = data.judul_iw || '';
        document.querySelector('#formIw [name="tiket_iw"]').value = data.tiket_iw || 0;
        document.querySelector('#formIw [name="deskripsi_iw"]').value = data.deskripsi_iw || '';
        document.querySelector('#formIw [name="buka_iw"]').value = data.buka_iw || '';
        document.querySelector('#formIw [name="tutup_iw"]').value = data.tutup_iw || '';
        var preview = document.getElementById('previewFotoIw');
        if(data.foto_iw) {
            if(data.foto_iw.startsWith('http://') || data.foto_iw.startsWith('https://')) {
                preview.src = data.foto_iw;
            } else {
                preview.src = '/' + data.foto_iw;
            }
        } else {
            preview.src = "data:image/svg+xml,%3Csvg width='120' height='80' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='120' height='80' fill='%23e9ecef'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-size='14' fill='%236c757d'%3EPreview%3C/text%3E%3C/svg%3E";
        }
        var modal = new bootstrap.Modal(document.getElementById('modalTambahIw'));
        modal.show();
    }
    document.getElementById('formIw').onsubmit = function(e) {
        e.preventDefault();
        var form = this;
        var fd = new FormData(form);
        var url = '/dashboard/wisata/tambah';
        if(idEditIw) url = '/dashboard/wisata/edit/' + idEditIw;
        fetch(url, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': getCsrfToken() },
            body: fd
        })
        .then(r => r.json())
        .then(res => {
            if(res.success) {
                Swal.fire('Tersimpan!', 'Data wisata berhasil disimpan.', 'success').then(() => location.reload());
            }
        });
        bootstrap.Modal.getInstance(document.getElementById('modalTambahIw')).hide();
        form.reset();
        document.getElementById('previewFotoIw').src = "data:image/svg+xml,%3Csvg width='120' height='80' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='120' height='80' fill='%23e9ecef'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-size='14' fill='%236c757d'%3EPreview%3C/text%3E%3C/svg%3E";
        idEditIw = null;
    };
</script>
@endpush
@endsection
