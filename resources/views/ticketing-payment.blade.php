@extends('layouts.app')

@section('content')
@php
    $user = session('user');
@endphp
@include('components.navbar')
<main class="bg-light py-5 min-vh-100">
    <div class="container">
        <h1 class="text-center fw-bold mb-5">Pembayaran Tiket Wisata</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div id="pembayaran-info">
                            <div class="mb-3">
                                <label class="form-label">Resi Tiket</label>
                                <input type="text" class="form-control" id="pay_resi" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Wisata</label>
                                <input type="text" class="form-control" id="pay_wisata" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Kunjungan</label>
                                <input type="text" class="form-control" id="pay_tanggal" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah Tiket</label>
                                <input type="text" class="form-control" id="pay_qty" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Total Harga</label>
                                <input type="text" class="form-control" id="pay_total" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="pay_metode" required>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="qris">QRIS</option>
                            </select>
                        </div>
                        <div id="pay_info_transfer" class="mb-3 d-none">
                            <div class="alert alert-info mb-2">
                                <div><b>Transfer ke rekening:</b></div>
                                <div>Bank Dummy 1234567890 a.n. Bukit Eon</div>
                                <hr class="my-2">
                                <div class="fw-bold">Catatan:</div>
                                <ul class="mb-1">
                                    <li>Setelah transfer, <b>ambil screenshoot bukti pembayaran</b>.</li>
                                    <li>Kirim bukti pembayaran tersebut ke WhatsApp konfirmasi dengan klik tombol di bawah.</li>
                                </ul>
                                <div class="small text-muted">Contoh pesan WA:<br>
                                    <span class="fst-italic">"Halo admin, saya sudah melakukan pembayaran tiket dengan resi <span id='wa_resi_transfer'></span> sejumlah <span id='wa_nominal_transfer'></span>. Berikut saya lampirkan bukti transfernya. Terima kasih."</span>
                                </div>
                            </div>
                            <a id="btnWaTransfer" href="#" target="_blank" class="btn btn-success w-100 mb-2"><i class="bi bi-whatsapp"></i> Konfirmasi via WhatsApp</a>
                        </div>
                        <div id="pay_info_qris" class="mb-3 d-none">
                            <div class="alert alert-info mb-2">
                                <div><b>Scan QRIS berikut untuk pembayaran:</b></div>
                                <img src="https://via.placeholder.com/200x200?text=QRIS" alt="QRIS" class="img-fluid my-2">
                                <div>Atau transfer ke Bank Dummy 1234567890 a.n. Bukit Eon</div>
                                <hr class="my-2">
                                <div class="fw-bold">Catatan:</div>
                                <ul class="mb-1">
                                    <li>Setelah pembayaran, <b>ambil screenshoot bukti pembayaran</b>.</li>
                                    <li>Kirim bukti pembayaran tersebut ke WhatsApp konfirmasi dengan klik tombol di bawah.</li>
                                </ul>
                                <div class="small text-muted">Contoh pesan WA:<br>
                                    <span class="fst-italic">"Halo admin, saya sudah melakukan pembayaran tiket dengan resi <span id='wa_resi_qris'></span> sejumlah <span id='wa_nominal_qris'></span> via QRIS. Berikut saya lampirkan bukti pembayaran. Terima kasih."</span>
                                </div>
                            </div>
                            <a id="btnWaQris" href="#" target="_blank" class="btn btn-success w-100 mb-2"><i class="bi bi-whatsapp"></i> Konfirmasi via WhatsApp</a>
                        </div>
                        <div id="pay_info_cash" class="mb-3 d-none">
                            <div class="alert alert-info mb-2">
                                <div class="fw-bold">Catatan:</div>
                                <ul class="mb-1">
                                    <li>Pembayaran dilakukan <b>langsung di kasir (on the spot)</b>.</li>
                                    <li>Tunjukkan <b>resi tiket</b> ini ke petugas kasir saat pembayaran.</li>
                                </ul>
                                <div class="small text-muted">Contoh kalimat ke kasir:<br>
                                    <span class="fst-italic">"Saya ingin membayar tiket dengan resi <span id='wa_resi_cash'></span>."</span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success w-100" id="btnBayar">Selesaikan Pembayaran</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let resi = sessionStorage.getItem('pemesanan_tiket_resi');
    if (!resi) {
        Swal.fire({ icon: 'error', title: 'Data Tidak Ditemukan', text: 'Data pemesanan tiket tidak ditemukan.', confirmButtonText: 'Kembali', allowOutsideClick: false }).then(()=>window.location.href='/ticketing');
        return;
    }
    const metode = document.getElementById('pay_metode');
    const infoTransfer = document.getElementById('pay_info_transfer');
    const infoQris = document.getElementById('pay_info_qris');
    const infoCash = document.getElementById('pay_info_cash');
    const btnWaTransfer = document.getElementById('btnWaTransfer');
    const btnWaQris = document.getElementById('btnWaQris');
    const rekening = 'Bank Dummy 1234567890 a.n. Bukit Eon';
    const waNo = '6281234567890'; // dummy nomor
    function getWaTextTransfer(data) {
        return encodeURIComponent(`Halo admin, saya sudah melakukan pembayaran tiket dengan resi ${data.resi_tiket} sejumlah ${data.total_harga}. Berikut saya lampirkan bukti transfernya. Terima kasih.`);
    }
    function getWaTextQris(data) {
        return encodeURIComponent(`Halo admin, saya sudah melakukan pembayaran tiket dengan resi ${data.resi_tiket} sejumlah ${data.total_harga} via QRIS. Berikut saya lampirkan bukti pembayaran. Terima kasih.`);
    }
    fetch(`/ticketing/order/${resi}`)
        .then(resp => {
            if (!resp.ok) throw new Error('Pesanan tidak ditemukan');
            return resp.json();
        })
        .then(data => {
            document.getElementById('pay_resi').value = data.resi_tiket;
            document.getElementById('pay_wisata').value = data.judul_iw;
            document.getElementById('pay_tanggal').value = data.tanggal_tiket || data.tanggal;
            document.getElementById('pay_qty').value = data.qty_tiket || data.qty;
            document.getElementById('pay_total').value = data.total_tiket || data.total_harga;
            // Set dynamic resi/nominal for WA/cash notes
            document.getElementById('wa_resi_transfer').textContent = data.resi_tiket;
            document.getElementById('wa_nominal_transfer').textContent = data.total_tiket || data.total_harga;
            document.getElementById('wa_resi_qris').textContent = data.resi_tiket;
            document.getElementById('wa_nominal_qris').textContent = data.total_tiket || data.total_harga;
            document.getElementById('wa_resi_cash').textContent = data.resi_tiket;
            // Update WA links
            btnWaTransfer.href = `https://wa.me/${waNo}?text=${getWaTextTransfer(data)}`;
            btnWaQris.href = `https://wa.me/${waNo}?text=${getWaTextQris(data)}`;
            // Event listener untuk metode pembayaran
            metode.addEventListener('change', function() {
                infoTransfer.classList.add('d-none');
                infoQris.classList.add('d-none');
                infoCash.classList.add('d-none');
                if(this.value === 'transfer') {
                    infoTransfer.classList.remove('d-none');
                    btnWaTransfer.href = `https://wa.me/${waNo}?text=${getWaTextTransfer(data)}`;
                } else if(this.value === 'qris') {
                    infoQris.classList.remove('d-none');
                    btnWaQris.href = `https://wa.me/${waNo}?text=${getWaTextQris(data)}`;
                } else if(this.value === 'cash') {
                    infoCash.classList.remove('d-none');
                }
            });
            metode.dispatchEvent(new Event('change'));
        })
        .catch(err => {
            Swal.fire({ icon: 'error', title: 'Gagal', text: err.message, confirmButtonText: 'Kembali' }).then(()=>window.location.href='/ticketing');
        });

    document.getElementById('btnBayar').onclick = function() {
        if(metode.value === 'cash') {
            Swal.fire({ icon: 'success', title: 'Pembayaran Cash', text: 'Tiket berhasil divalidasi. Silakan lakukan pembayaran di kasir.', confirmButtonText: 'OK' }).then(()=>{
                sessionStorage.removeItem('pemesanan_tiket');
                sessionStorage.removeItem('pemesanan_tiket_resi');
                window.location.href = '/history';
            });
        } else if(metode.value === 'transfer') {
            Swal.fire({ icon: 'info', title: 'Transfer Bank', html: 'Silakan transfer ke rekening berikut:<br><b>'+rekening+'</b><br>Lalu konfirmasi via WhatsApp.', confirmButtonText: 'OK' }).then(()=>{
                sessionStorage.removeItem('pemesanan_tiket');
                sessionStorage.removeItem('pemesanan_tiket_resi');
                window.location.href = '/history';
            });
        } else if(metode.value === 'qris') {
            Swal.fire({ icon: 'info', title: 'Pembayaran QRIS', html: 'Silakan scan QRIS di bawah lalu konfirmasi via WhatsApp.', confirmButtonText: 'OK' }).then(()=>{
                sessionStorage.removeItem('pemesanan_tiket');
                sessionStorage.removeItem('pemesanan_tiket_resi');
                window.location.href = '/history';
            });
        }
    };
});
</script>
@endsection
