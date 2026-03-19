@extends('layouts.dashboard')

@section('dashboard-content')
<div class="py-4">
    <div class="row mb-4">
        <div class="col-12">
            <a href="/dashboard/wisata" class="btn btn-outline-secondary mb-3">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Wisata
            </a>
            <h2 class="fw-bold">{{ isset($wisata) ? 'Edit Wisata' : 'Tambah Wisata Baru' }}</h2>
            <p class="text-muted">Kelola informasi wisata, gambar, dan detail operasional</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Form Input -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form id="formWisata" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Informasi Dasar -->
                        <div class="mb-4">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="bi bi-info-circle me-2"></i>Informasi Dasar
                            </h5>
                            
                            <div class="mb-3">
                                <label for="judul_iw" class="form-label">Nama Wisata <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="judul_iw" name="judul_iw" 
                                    placeholder="Contoh: Puncak View, Taman Bunga, dll" 
                                    value="{{ isset($wisata) ? $wisata->judul_iw : '' }}" required>
                                <small class="text-muted">Nama unik untuk identitas wisata Anda</small>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi_iw" class="form-label">Keterangan / Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="deskripsi_iw" name="deskripsi_iw" 
                                    rows="5" placeholder="Tuliskan deskripsi lengkap tentang wisata ini, fasilitas, keunikan, dll">{{ isset($wisata) ? $wisata->deskripsi_iw : '' }}</textarea>
                                <small class="text-muted">Jelaskan detail menarik tentang wisata ini untuk menarik pengunjung</small>
                            </div>
                        </div>

                        <hr>

                        <!-- Informasi Operasional -->
                        <div class="mb-4">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="bi bi-clock me-2"></i>Informasi Operasional
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="buka_iw" class="form-label">Jam Buka</label>
                                    <input type="time" class="form-control" id="buka_iw" name="buka_iw" 
                                        value="{{ isset($wisata) && $wisata->buka_iw ? substr($wisata->buka_iw, 0, 5) : '' }}">
                                    <small class="text-muted">Format HH:MM</small>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="tutup_iw" class="form-label">Jam Tutup</label>
                                    <input type="time" class="form-control" id="tutup_iw" name="tutup_iw" 
                                        value="{{ isset($wisata) && $wisata->tutup_iw ? substr($wisata->tutup_iw, 0, 5) : '' }}">
                                    <small class="text-muted">Format HH:MM</small>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Harga Tiket -->
                        <div class="mb-4">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="bi bi-ticket-perforated me-2"></i>Harga Tiket Masuk
                            </h5>

                            <div class="col-md-6">
                                <label for="tiket_iw" class="form-label">Harga Tiket (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="tiket_iw" name="tiket_iw" 
                                        placeholder="0 untuk gratis" value="{{ isset($wisata) ? $wisata->tiket_iw ?? 0 : 0 }}">
                                </div>
                                <small class="text-muted">Masukkan 0 jika tiket gratis</small>
                            </div>
                        </div>

                        <hr>

                        <!-- Upload Foto -->
                        <div class="mb-4">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="bi bi-image me-2"></i>Foto Wisata
                            </h5>

                            <div class="mb-3">
                                <label for="foto_iw" class="form-label">Upload atau Ganti Gambar</label>
                                <input type="file" class="form-control" id="foto_iw" name="foto_iw" 
                                    accept="image/*" onchange="window.previewFotoWisata(event)">
                                <small class="text-muted">Format: JPG, PNG, GIF (Maksimal 5MB). Gambar akan di-resize otomatis.</small>
                            </div>

                            <div class="mb-3">
                                @if(isset($wisata) && $wisata->foto_iw)
                                    <small class="d-block mb-2"><strong>Gambar Saat Ini:</strong></small>
                                    <div class="border rounded p-2 mb-3 bg-light" style="display: inline-block;">
                                        @if(Str::startsWith($wisata->foto_iw, ['http://', 'https://']))
                                            <img src="{{ $wisata->foto_iw }}" style="max-width:200px;max-height:200px;object-fit:cover;border-radius:6px;" alt="Foto Wisata">
                                        @else
                                            <img src="/{{ $wisata->foto_iw }}" style="max-width:200px;max-height:200px;object-fit:cover;border-radius:6px;" alt="Foto Wisata">
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <small class="d-block mb-2"><strong>Preview Foto Baru:</strong></small>
                                <div class="border rounded p-3 text-center bg-light">
                                    <img id="previewFotoWisata" src="data:image/svg+xml,%3Csvg width='200' height='150' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='200' height='150' fill='%23e9ecef'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-size='14' fill='%236c757d'%3EPreview Gambar%3C/text%3E%3C/svg%3E" 
                                        style="max-width:100%;max-height:200px;object-fit:cover;border-radius:6px;" alt="Preview">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>{{ isset($wisata) ? 'Perbarui Wisata' : 'Tambah Wisata' }}
                            </button>
                            <a href="/dashboard/wisata" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow-sm mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <div class="card-body">
                    <h6 class="card-title fw-bold mb-2">
                        <i class="bi bi-lightbulb me-2"></i>Tips Pengisian Form
                    </h6>
                    <ul class="small mb-0" style="list-style: none; padding: 0;">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Gunakan nama wisata yang <strong>unik dan menarik</strong>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Deskripsi yang <strong>detail dan rinci</strong> akan menarik lebih banyak pengunjung
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Foto berkualitas tinggi dengan resolusi minimal <strong>1200x800px</strong>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Setting jam buka/tutup sesuai operasional Anda
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Harga tiket dapat diubah kapan saja sesuai kebutuhan
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title fw-bold mb-3">
                        <i class="bi bi-file-earmark-text me-2"></i>Informasi Tambahan
                    </h6>
                    <div class="small">
                        @if(isset($wisata))
                            <p class="mb-2">
                                <strong>ID Wisata:</strong><br>
                                <code>{{ $wisata->id_iw }}</code>
                            </p>
                            <p class="mb-2">
                                <strong>Dibuat Oleh:</strong><br>
                                {{ $wisata->user->nama_user ?? '-' }}
                            </p>
                            <p class="mb-0">
                                <strong>Diperbarui:</strong><br>
                                {{ $wisata->updated_at_iw ?? '-' }}
                            </p>
                        @else
                            <p class="text-muted mb-0">
                                Form untuk menambah wisata baru. Semua data akan tercatat secara otomatis.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function getCsrfToken() {
        return document.querySelector('meta[name=csrf-token]')?.content || '';
    }

    window.previewFotoWisata = function(event) {
        const input = event.target;
        const preview = document.getElementById('previewFotoWisata');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "data:image/svg+xml,%3Csvg width='200' height='150' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='200' height='150' fill='%23e9ecef'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-size='14' fill='%236c757d'%3EPreview Gambar%3C/text%3E%3C/svg%3E";
        }
    };

    document.getElementById('formWisata').onsubmit = function(e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);
        const judulWisata = document.getElementById('judul_iw').value.trim();

        // Validasi client-side
        if (!judulWisata) {
            Swal.fire('Perhatian!', 'Nama wisata tidak boleh kosong', 'warning');
            return false;
        }

        // Validasi ukuran file gambar
        const fotoInput = document.getElementById('foto_iw');
        if (fotoInput.files && fotoInput.files[0]) {
            const maxSize = 5 * 1024 * 1024; // 5MB
            if (fotoInput.files[0].size > maxSize) {
                Swal.fire('Perhatian!', 'Ukuran gambar tidak boleh lebih dari 5MB', 'warning');
                return false;
            }
        }

        const url = '{{ isset($wisata) ? "/dashboard/wisata/edit/" . $wisata->id_iw : "/dashboard/wisata/tambah" }}';
        
        Swal.fire({
            title: 'Sedang menyimpan...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(url, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': getCsrfToken() },
            body: formData
        })
        .then(r => r.json())
        .then(res => {
            if(res.success) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ isset($wisata) ? "Data wisata berhasil diperbarui" : "Wisata baru berhasil ditambahkan" }}',
                    icon: 'success',
                    confirmButtonText: 'Lihat Daftar Wisata'
                }).then(() => {
                    window.location.href = '/dashboard/wisata';
                });
            } else {
                Swal.fire('Gagal!', res.message || 'Terjadi kesalahan saat menyimpan data', 'error');
            }
        })
        .catch(err => {
            Swal.fire('Gagal!', 'Terjadi kesalahan: ' + err.message, 'error');
        });
    };
</script>
@endpush

@endsection
