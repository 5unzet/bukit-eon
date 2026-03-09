@extends('layouts.app')

@section('content')
@include('components.navdash')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Makanan Baru</div>
                <div class="card-body">
                    <form id="formMakanan" action="{{ route('book.newMakanan.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="no_resi" class="form-label">No Resi</label>
                            <input type="text" class="form-control" id="no_resi" name="no_resi" value="{{ 'ORD-' . strtoupper(Str::random(8)) }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_order" class="form-label">Tanggal Order</label>
                            <input type="date" class="form-control" id="tanggal_order" name="tanggal_order" value="{{ now()->setTimezone('Asia/Jakarta')->format('Y-m-d') }}" required>
                        </div>
                        <input type="hidden" name="waktu_order" value="{{ now('Asia/Jakarta')->format('H:i:s') }}">
                        <div class="mb-3">
                            <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                            <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" placeholder="Nama Konsumen" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_meja" class="form-label">Nomor Meja</label>
                            <input type="text" class="form-control" id="no_meja" name="no_meja" placeholder="Nomor/Label Meja" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_order" class="form-label">Tanggal Order</label>
                            <input type="date" class="form-control" id="tanggal_order" name="tanggal_order" value="{{ now()->setTimezone('Asia/Jakarta')->format('Y-m-d') }}" required>
                        </div>
                        <input type="hidden" name="waktu_order" value="{{ now('Asia/Jakarta')->format('H:i:s') }}">
                        <hr>
                        <label class="form-label">Daftar Pesanan Makanan</label>
                        <div id="makanan-list"></div>
                        <button type="button" class="btn btn-outline-success mb-3" id="btnAddMakanan">+ Tambah Makanan</button>
                        <div class="mb-3">
                            <label class="form-label">Total Semua Pesanan</label>
                            <input type="text" class="form-control" id="grand_total" name="grand_total" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Pesan Makanan</button>
                    </form>
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        $('#id_makanan').on('change', function() {
                            const harga = $(this).find(':selected').data('harga') || 0;
                            $('#harga_makanan').val(harga);
                            updateTotalHarga();
                        });
                        $('#jumlah').on('input', function() {
                            updateTotalHarga();
                        });
                        function updateTotalHarga() {
                            const harga = parseInt($('#harga_makanan').val() || 0);
                            const qty = parseInt($('#jumlah').val() || 0);
                            $('#total_harga').val(harga * qty);
                        }
                    });
                    </script>
                    <script>
                    @php
                        $makanans = \App\Models\Makan::where('status_makan', 'VALID')->where('ketersediaan_makan', 'OPEN')->orderBy('nama_makan')->get();
                    @endphp
                    const makanans = @json($makanans);
                    function makananRow(idx, selected, qty, note) {
                        let options = '<option value="">-- Pilih Makanan --</option>';
                        makanans.forEach(m => {
                            options += `<option value="${m.id_makan}" data-harga="${m.harga_makan}" ${selected==m.id_makan?'selected':''}>${m.nama_makan}</option>`;
                        });
                        return `
                        <div class="row align-items-end mb-2 makanan-row" data-idx="${idx}">
                            <div class="col-md-3">
                                <label class="form-label">Makanan</label>
                                <select class="form-select makanan-select" name="makanans[${idx}][id_makanan]" required>${options}</select>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label">Qty</label>
                                <input type="number" class="form-control qty-input" name="makanans[${idx}][qty]" min="1" value="${qty||1}" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Harga</label>
                                <input type="text" class="form-control harga-input" name="makanans[${idx}][harga]" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Subtotal</label>
                                <input type="text" class="form-control subtotal-input" name="makanans[${idx}][subtotal]" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Catatan</label>
                                <input type="text" class="form-control" name="makanans[${idx}][catatan]" value="${note||''}" placeholder="Catatan (opsional)">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btnRemoveMakanan">&times;</button>
                            </div>
                        </div>`;
                    }
                    function updateHargaDanTotal() {
                        let grand = 0;
                        document.querySelectorAll('.makanan-row').forEach(row => {
                            const select = row.querySelector('.makanan-select');
                            const harga = select.options[select.selectedIndex]?.getAttribute('data-harga') || 0;
                            row.querySelector('.harga-input').value = harga;
                            const qty = row.querySelector('.qty-input').value || 0;
                            const subtotal = parseInt(harga) * parseInt(qty);
                            row.querySelector('.subtotal-input').value = subtotal;
                            grand += subtotal;
                        });
                        document.getElementById('grand_total').value = grand;
                    }
                    function addMakananRow(idx, selected, qty, note) {
                        const list = document.getElementById('makanan-list');
                        const temp = document.createElement('div');
                        temp.innerHTML = makananRow(idx, selected, qty, note);
                        list.appendChild(temp.firstElementChild);
                        updateHargaDanTotal();
                    }
                    function reindexRows() {
                        document.querySelectorAll('.makanan-row').forEach((row, i) => {
                            row.setAttribute('data-idx', i);
                            row.querySelector('.makanan-select').setAttribute('name', `makanans[${i}][id_makanan]`);
                            row.querySelector('.qty-input').setAttribute('name', `makanans[${i}][qty]`);
                            row.querySelector('.harga-input').setAttribute('name', `makanans[${i}][harga]`);
                            row.querySelector('input[name$="[catatan]"]').setAttribute('name', `makanans[${i}][catatan]`);
                        });
                    }
                    document.addEventListener('DOMContentLoaded', function() {
                        let idx = 0;
                        addMakananRow(idx++);
                        document.getElementById('btnAddMakanan').onclick = function() {
                            addMakananRow(idx++);
                        };
                        document.getElementById('makanan-list').addEventListener('change', function(e) {
                            if(e.target.classList.contains('makanan-select') || e.target.classList.contains('qty-input')) {
                                updateHargaDanTotal();
                            }
                        });
                        document.getElementById('makanan-list').addEventListener('click', function(e) {
                            if(e.target.classList.contains('btnRemoveMakanan')) {
                                e.target.closest('.makanan-row').remove();
                                reindexRows();
                                updateHargaDanTotal();
                            }
                        });
                        document.getElementById('formMakanan').onsubmit = function(e) {
                            if(document.querySelectorAll('.makanan-row').length === 0) {
                                e.preventDefault();
                                alert('Minimal 1 makanan harus diisi!');
                            }
                        };
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
