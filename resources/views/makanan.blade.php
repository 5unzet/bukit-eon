@extends('layouts.dashboard')

@section('dashboard-content')
<div class="py-4">
    <h2 class="fw-bold mb-3">Manajemen Makanan</h2>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0">Kelola daftar makanan, stok, dan pesanan makanan di Bukit EON.</p>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMakan"><i class="bi bi-plus-circle me-1"></i>Tambah Makanan</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Ready</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    
                    <th>PIC</th>
                    <th>Updated</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($makanans as $i => $makan)
                <tr>
                    <td>{{ $makan->id_makan }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" {{ strtoupper($makan->ketersediaan_makan) === 'OPEN' ? 'checked' : '' }} onclick="toggleReady({{ $makan->id_makan }}, this)">
                        </div>
                    </td>
                    <td>{{ $makan->nama_makan }}</td>
                    <td>
                        @if($makan->gambar_makan)
                            @if(Str::startsWith($makan->gambar_makan, ['http://', 'https://']))
                                <img src="{{ $makan->gambar_makan }}" alt="{{ $makan->nama_makan }}" style="height:40px;width:40px;object-fit:cover;border-radius:6px;">
                            @else
                                <img src="/{{ $makan->gambar_makan }}" alt="{{ $makan->nama_makan }}" style="height:40px;width:40px;object-fit:cover;border-radius:6px;">
                            @endif
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $makan->deskripsi_makan }}</td>
                    <td>Rp {{ number_format($makan->harga_makan,0,',','.') }}</td>
                    <td>{{ $makan->user->nama_user ?? '-' }}</td>
                    <td>{{ $makan->updated_at_makan }}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-warning me-1" onclick="editMakan({{ $makan->id_makan }})"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-sm btn-outline-danger" onclick="hapusMakan({{ $makan->id_makan }})"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">Belum ada data makanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah/Edit Makanan -->
    <div class="modal fade" id="modalTambahMakan" tabindex="-1" aria-labelledby="modalTambahMakanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahMakanLabel">Tambah/Edit Makanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formMakan">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Makanan</label>
                                <input type="text" class="form-control" name="nama_makan" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga_makan" value="0" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi_makan" rows="2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar_makan" accept="image/*" onchange="window.previewGambarMakan(event)">
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="w-100">
                                    <label class="form-label">Preview</label>
                                    <div class="border rounded p-2 text-center bg-light">
                                        <img id="previewGambarMakan" src="data:image/svg+xml,%3Csvg width='120' height='80' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='120' height='80' fill='%23e9ecef'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-size='14' fill='%236c757d'%3EPreview%3C/text%3E%3C/svg%3E" style="max-width:120px;max-height:80px;object-fit:cover;" alt="Preview Gambar">
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
    window.makanans = (@json($makanans)).map(function(makan) {
        return {
            id_makan: makan.id_makan,
            nama_makan: makan.nama_makan,
            harga_makan: makan.harga_makan,
            deskripsi_makan: makan.deskripsi_makan,
            gambar_makan: makan.gambar_makan
        };
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // State id edit
    let idEditMakan = null;

    function getCsrfToken() {
        var meta = document.querySelector('meta[name=csrf-token]');
        return meta ? meta.content : '';
    }

    function hapusMakan(id) {
        Swal.fire({
            title: 'Hapus Makanan?',
            text: 'Data makanan akan dihapus (status VOID)!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/dashboard/makanan/hapus/${id}`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': getCsrfToken() },
                })
                .then(r => r.json())
                .then(res => {
                    if(res.success) {
                        Swal.fire('Terhapus!', 'Data makanan berhasil dihapus.', 'success').then(() => location.reload());
                    }
                });
            }
        });
    }

    function toggleReady(id, el) {
        el.disabled = true;
        fetch(`/dashboard/makanan/toggle-ready/${id}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': getCsrfToken() },
        })
        .then(r => r.json())
        .then(res => {
            el.checked = (res.ketersediaan_makan === 'OPEN');
            el.disabled = false;
        });
    }
    // Switch ready tidak perlu label open/close
    window.previewGambarMakan = function(event) {
        const input = event.target;
        const preview = document.getElementById('previewGambarMakan');
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

    window.editMakan = function(id) {
        idEditMakan = id;
        var data = (window.makanans || []).find(function(m) { return m.id_makan == id });
        if(!data) return;
        document.querySelector('#formMakan [name="nama_makan"]').value = data.nama_makan || '';
        document.querySelector('#formMakan [name="harga_makan"]').value = data.harga_makan || 0;
        document.querySelector('#formMakan [name="deskripsi_makan"]').value = data.deskripsi_makan || '';
        var preview = document.getElementById('previewGambarMakan');
        if(data.gambar_makan) {
            if(data.gambar_makan.startsWith('http://') || data.gambar_makan.startsWith('https://')) {
                preview.src = data.gambar_makan;
            } else {
                preview.src = '/' + data.gambar_makan;
            }
        } else {
            preview.src = "data:image/svg+xml,%3Csvg width='120' height='80' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='120' height='80' fill='%23e9ecef'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-size='14' fill='%236c757d'%3EPreview%3C/text%3E%3C/svg%3E";
        }
        var modal = new bootstrap.Modal(document.getElementById('modalTambahMakan'));
        modal.show();
    }
    document.getElementById('formMakan').onsubmit = function(e) {
        e.preventDefault();
        var form = this;
        var fd = new FormData(form);
        var url = '/dashboard/makanan/tambah';
        if(idEditMakan) url = '/dashboard/makanan/edit/' + idEditMakan;
        fetch(url, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': getCsrfToken() },
            body: fd
        })
        .then(r => r.json())
        .then(res => {
            if(res.success) {
                Swal.fire('Tersimpan!', 'Data makanan berhasil disimpan.', 'success').then(() => location.reload());
            }
        });
        bootstrap.Modal.getInstance(document.getElementById('modalTambahMakan')).hide();
        form.reset();
        document.getElementById('previewGambarMakan').src = "data:image/svg+xml,%3Csvg width='120' height='80' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='120' height='80' fill='%23e9ecef'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-size='14' fill='%236c757d'%3EPreview%3C/text%3E%3C/svg%3E";
        idEditMakan = null;
    };

</script>
@endpush
@endsection
