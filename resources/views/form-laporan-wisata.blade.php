@extends('layouts.dashboard')

@section('dashboard-content')
<div class="py-4">
    <div class="row mb-4">
        <div class="col-12">
            <a href="/dashboard/laporan/wisata" class="btn btn-outline-secondary mb-3">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Laporan
            </a>
            <h2 class="fw-bold">{{ isset($laporan) ? 'Edit Laporan Wisata' : 'Tambah Laporan Wisata Baru' }}</h2>
            <p class="text-muted">Buat atau perbarui laporan, ulasan, dan artikel tentang wisata</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Form Input -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form id="formLaporan" enctype="multipart/form-data">
                        @csrf

                        <!-- Judul Laporan -->
                        <div class="mb-4">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="bi bi-pencil-square me-2"></i>Judul Laporan
                            </h5>
                            <div class="mb-3">
                                <label for="judul_laporan" class="form-label">Judul <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="judul_laporan" name="judul_laporan" 
                                    placeholder="Contoh: Review Wisata Bukit Eon" 
                                    value="{{ isset($laporan) ? $laporan->judul_laporan : '' }}" required>
                                <small class="text-muted">Judul yang menarik akan lebih mudah dibaca.</small>
                            </div>
                        </div>

                        <hr>

                        <!-- Upload Foto -->
                        <div class="mb-4">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="bi bi-image me-2"></i>Foto Laporan
                            </h5>

                            <div class="mb-3">
                                <label for="foto_laporan" class="form-label">Upload atau Ganti Gambar</label>
                                <input type="file" class="form-control" id="foto_laporan" name="foto_laporan" 
                                    accept="image/*" onchange="window.previewFotoLaporan(event)">
                                <small class="text-muted">Format: JPG, PNG, GIF (Maksimal 5MB). Gambar akan di-resize otomatis.</small>
                            </div>

                            <div class="mb-3">
                                @if(isset($laporan) && $laporan->foto_laporan)
                                    <small class="d-block mb-2"><strong>Gambar Saat Ini:</strong></small>
                                    <div class="border rounded p-2 mb-3 bg-light" style="display: inline-block;">
                                        @if(Str::startsWith($laporan->foto_laporan, ['http://', 'https://']))
                                            <img src="{{ $laporan->foto_laporan }}" style="max-width:250px;max-height:200px;object-fit:cover;border-radius:6px;" alt="Foto Laporan">
                                        @else
                                            <img src="/{{ $laporan->foto_laporan }}" style="max-width:250px;max-height:200px;object-fit:cover;border-radius:6px;" alt="Foto Laporan">
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <small class="d-block mb-2"><strong>Preview Foto Baru:</strong></small>
                                <div class="border rounded p-3 text-center bg-light">
                                    <img id="previewFotoLaporan" src="data:image/svg+xml,%3Csvg width='250' height='200' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='250' height='200' fill='%23e9ecef'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-size='14' fill='%236c757d'%3EPreview Gambar%3C/text%3E%3C/svg%3E" 
                                        style="max-width:100%;max-height:250px;object-fit:cover;border-radius:6px;" alt="Preview">
                                </div>
                            </div>
                        </div>

                         <hr>

                        <!-- Keterangan -->
                        <div class="mb-4">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="bi bi-file-text me-2"></i>Keterangan / Isi Laporan
                            </h5>

                            <div class="mb-3">
                                <label for="keterangan_laporan" class="form-label">Keterangan Lengkap <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="keterangan_laporan" name="keterangan_laporan" 
                                    rows="8" placeholder="Tulis laporan, ulasan, atau artikel lengkap di sini...">{{ isset($laporan) ? $laporan->keterangan_laporan : '' }}</textarea>
                                <small class="text-muted">Minimal 20 karakter. Gunakan paragraf yang jelas dan mudah dibaca.</small>
                            </div>

                            <!-- Word Count -->
                            <div class="alert alert-light mb-3">
                                <small>
                                    <strong>Panjang teks:</strong> <span id="wordCount">0</span> karakter
                                </small>
                            </div>
                        </div>

                        <hr>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>{{ isset($laporan) ? 'Perbarui Laporan' : 'Buat Laporan' }}
                            </button>
                            <a href="/dashboard/laporan/wisata" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow-sm mb-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                <div class="card-body">
                    <h6 class="card-title fw-bold mb-2">
                        <i class="bi bi-lightbulb me-2"></i>Tips Menulis Bagus
                    </h6>
                    <ul class="small mb-0" style="list-style: none; padding: 0;">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Judul yang <strong>menarik dan informatif</strong>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Gunakan <strong>paragraf singkat</strong> dan jelas
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Tambahkan <strong>foto berkualitas tinggi</strong>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Mulai dengan <strong>pengantar yang menarik</strong>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            <strong>Minimal 50 karakter</strong> keterangan
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Tutup dengan <strong>kesimpulan atau ajakan</strong>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title fw-bold mb-3">
                        <i class="bi bi-info-circle me-2"></i>Panduan Konten
                    </h6>
                    <div class="small">
                        <p class="mb-2">
                            <strong>Jenis Konten:</strong>
                        </p>
                        <ul class="ps-3 mb-3" style="list-style: circle;">
                            <li>Tips & Trik Liburan</li>
                            <li>Review Destinasi</li>
                            <li>Cerita Pengalaman</li>
                            <li>Panduan Kunjungan</li>
                            <li>Berita Terbaru</li>
                        </ul>

                        @if(isset($laporan))
                            <p class="mb-0">
                                <strong>ID:</strong> {{ $laporan->id_laporan }}<br>
                                <strong>Dibuat:</strong> {{ date('d M Y H:i', strtotime($laporan->created_at_laporan)) }}<br>
                                <strong>Terakhir Diubah:</strong> {{ date('d M Y H:i', strtotime($laporan->updated_at_laporan)) }}
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

    // Update word count
    document.getElementById('keterangan_laporan').addEventListener('input', function() {
        document.getElementById('wordCount').textContent = this.value.length;
    });

    // Initialize word count on load
    window.addEventListener('DOMContentLoaded', function() {
        document.getElementById('wordCount').textContent = document.getElementById('keterangan_laporan').value.length;
    });

    window.previewFotoLaporan = function(event) {
        const input = event.target;
        const preview = document.getElementById('previewFotoLaporan');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "data:image/svg+xml,%3Csvg width='250' height='200' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='250' height='200' fill='%23e9ecef'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-size='14' fill='%236c757d'%3EPreview Gambar%3C/text%3E%3C/svg%3E";
        }
    };

    document.getElementById('formLaporan').onsubmit = function(e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);
        const judulLaporan = document.getElementById('judul_laporan').value.trim();
        const keteranganLaporan = document.getElementById('keterangan_laporan').value.trim();

        // Validasi client-side
        if (!judulLaporan) {
            Swal.fire('Perhatian!', 'Judul laporan tidak boleh kosong', 'warning');
            return false;
        }

        if (keteranganLaporan.length < 20) {
            Swal.fire('Perhatian!', 'Keterangan minimal 20 karakter', 'warning');
            return false;
        }

        // Validasi ukuran file gambar
        const fotoInput = document.getElementById('foto_laporan');
        if (fotoInput.files && fotoInput.files[0]) {
            const maxSize = 5 * 1024 * 1024; // 5MB
            if (fotoInput.files[0].size > maxSize) {
                Swal.fire('Perhatian!', 'Ukuran gambar tidak boleh lebih dari 5MB', 'warning');
                return false;
            }
        }

        const url = '{{ isset($laporan) ? "/dashboard/laporan/wisata/edit/" . $laporan->id_laporan : "/dashboard/laporan/wisata/tambah" }}';
        
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
                    text: '{{ isset($laporan) ? "Laporan berhasil diperbarui" : "Laporan baru berhasil ditambahkan" }}',
                    icon: 'success',
                    confirmButtonText: 'Lihat Laporan'
                }).then(() => {
                    window.location.href = '/dashboard/laporan/wisata';
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
