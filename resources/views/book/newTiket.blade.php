@extends('layouts.app')

@section('content')
    @include('components.navdash')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order Tiket Baru</div>
                    <div class="card-body">
                        <!-- Modal Tambah Konsumen Baru (di luar form utama) -->
                        <div class="modal fade" id="modalAddCust" tabindex="-1" aria-labelledby="modalAddCustLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalAddCustLabel">Tambah Konsumen Baru</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formAddCust">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="mb-3">
                                                <label for="nama_cust" class="form-label">Nama Konsumen</label>
                                                <input type="text" class="form-control" id="nama_cust" name="nama_cust" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="no_hp_cust" class="form-label">No HP</label>
                                                <input type="text" class="form-control" id="no_hp_cust" name="no_hp_cust" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email_cust" class="form-label">Email (opsional)</label>
                                                <input type="email" class="form-control" id="email_cust" name="email_cust">
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100" id="btnSaveCust">
                                                <span id="btnTextCust">Simpan</span>
                                                <span id="btnSpinnerCust" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="formTiket" action="{{ route('book.newTiket.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label for="id_user_tiket" class="form-label">Nama Pemesan</label>
                                <select class="form-select" id="id_user_tiket" name="id_user_tiket" style="width:100%">
                                    <option value="">-- Pilih Customer --</option>
                                    @foreach($customers as $cust)
                                        <option value="{{ $cust->id_cust }}">{{ $cust->nama_cust }} ({{ $cust->no_hp_cust }})</option>
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-link p-0" id="btnShowAddCust">+ Tambah Konsumen Baru</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="id_iw_tiket" class="form-label">Pilih Wisata</label>
                                <select class="form-select" id="id_iw_tiket" name="id_iw_tiket" required onchange="updateHargaTiket()">
                                    <option value="">-- Pilih Wisata --</option>
                                    @foreach($wisatas as $iw)
                                        <option value="{{ $iw->id_iw }}" data-harga="{{ $iw->tiket_iw }}">{{ $iw->judul_iw }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga_tiket" class="form-label">Harga Tiket</label>
                                <input type="text" class="form-control" id="harga_tiket" name="harga_tiket" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="qty_tiket" class="form-label">Jumlah Tiket</label>
                                <input type="number" class="form-control" id="qty_tiket" name="qty_tiket" min="1" required oninput="updateTotalTiket()">
                            </div>
                            <div class="mb-3">
                                <label for="total_tiket" class="form-label">Total Harga</label>
                                <input type="text" class="form-control" id="total_tiket" name="total_tiket" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Kunjungan</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required value="{{ now()->setTimezone('Asia/Jakarta')->format('Y-m-d') }}">
                            </div>
                            <button type="submit" id="btnPesanTiket" class="btn btn-primary">
                                <span id="btnText">Pesan Tiket</span>
                                <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </form>
                        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                        <script>
                        // Inisialisasi select2 untuk customer
                        document.addEventListener('DOMContentLoaded', function() {
                            $('#id_user_tiket').select2({
                                placeholder: '-- Pilih Customer --',
                                allowClear: true,
                                width: '100%',
                                language: {
                                    noResults: function() {
                                        return 'Tidak ditemukan. <button type="button" class="btn btn-link p-0" id="inlineAddCust">+ Tambah Konsumen Baru</button>';
                                    }
                                },
                                escapeMarkup: function (markup) { return markup; }
                            });
                            // Event: klik tombol di dropdown select2
                            $(document).on('click', '#inlineAddCust', function(e) {
                                e.preventDefault();
                                $('#modalAddCust').modal('show');
                            });
                            // Event: klik tombol di bawah select
                            $('#btnShowAddCust').on('click', function() {
                                $('#modalAddCust').modal('show');
                            });
                        });

                        // Submit tambah konsumen baru
                        const formAddCust = document.getElementById('formAddCust');
                        if (formAddCust) {
                            formAddCust.addEventListener('submit', async function(e) {
                                e.preventDefault();
                                const btn = document.getElementById('btnSaveCust');
                                const btnText = document.getElementById('btnTextCust');
                                const btnSpinner = document.getElementById('btnSpinnerCust');
                                btn.disabled = true;
                                btnSpinner.classList.remove('d-none');
                                btnText.textContent = 'Menyimpan...';
                                const formData = new FormData(this);
                                try {
                                    const res = await fetch('/dashboard/book/add-cust', {
                                        method: 'POST',
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'X-CSRF-TOKEN': formData.get('_token'),
                                        },
                                        body: formData
                                    });
                                    const data = await res.json();
                                    if (data.success) {
                                        let msg = data.message;
                                        if (data.password) {
                                            msg += `\nPassword konsumen: <b>${data.password}</b>`;
                                        }
                                        Swal.fire({ icon: 'success', title: 'Berhasil', html: msg, showConfirmButton: true });
                                        // Tambahkan ke select2 dan pilih otomatis, TIDAK submit form booking otomatis
                                        const newOption = new Option(data.cust.nama_cust + ' (' + data.cust.no_hp_cust + ')', data.cust.id_cust, true, true);
                                        $('#id_user_tiket').append(newOption).val(data.cust.id_cust).trigger('change.select2');
                                        setTimeout(() => {
                                            $('#id_user_tiket').val(data.cust.id_cust).trigger('change.select2');
                                        }, 200);
                                        $('#modalAddCust').modal('hide');
                                        this.reset();
                                        // Pastikan form booking tiket TIDAK otomatis submit!
                                    } else {
                                        Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
                                    }
                                } catch (err) {
                                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan server.' });
                                }
                                btn.disabled = false;
                                btnSpinner.classList.add('d-none');
                                btnText.textContent = 'Simpan';
                            });
                        }

                        function updateHargaTiket() {
                            const iwSelect = document.getElementById('id_iw_tiket');
                            const harga = iwSelect.options[iwSelect.selectedIndex]?.getAttribute('data-harga') || 0;
                            document.getElementById('harga_tiket').value = harga;
                            updateTotalTiket();
                        }
                        function updateTotalTiket() {
                            const harga = parseInt(document.getElementById('harga_tiket').value || 0);
                            const qty = parseInt(document.getElementById('qty_tiket').value || 0);
                            document.getElementById('total_tiket').value = harga * qty;
                        }
                        const formTiket = document.getElementById('formTiket');
                        if (formTiket) {
                            formTiket.addEventListener('submit', async function(e) {
                                e.preventDefault();
                                const btn = document.getElementById('btnPesanTiket');
                                const btnText = document.getElementById('btnText');
                                const btnSpinner = document.getElementById('btnSpinner');
                                btn.disabled = true;
                                btnSpinner.classList.remove('d-none');
                                btnText.textContent = 'Memproses...';
                                const formData = new FormData(this);
                                try {
                                    const res = await fetch(this.action, {
                                        method: 'POST',
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'X-CSRF-TOKEN': formData.get('_token'),
                                        },
                                        body: formData
                                    });
                                    const data = await res.json();
                                    if (data.success) {
                                        Swal.fire({ icon: 'success', title: 'Berhasil', text: data.message, timer: 1500, showConfirmButton: false });
                                        setTimeout(() => window.location.reload(), 1600);
                                    } else {
                                        Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
                                        btn.disabled = false;
                                        btnSpinner.classList.add('d-none');
                                        btnText.textContent = 'Pesan Tiket';
                                    }
                                } catch (err) {
                                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan server.' });
                                    btn.disabled = false;
                                    btnSpinner.classList.add('d-none');
                                    btnText.textContent = 'Pesan Tiket';
                                }
                            });
                        }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
