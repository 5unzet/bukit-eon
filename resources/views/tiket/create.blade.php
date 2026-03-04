<h2>Tambah Tiket</h2>

<form method="POST" action="{{ route('tiket.store') }}">
@csrf
Tanggal: <input type="date" name="tanggal"><br>
Harga: <input type="number" name="harga"><br>
Kuota: <input type="number" name="kuota"><br>
<button type="submit">Simpan</button>
</form>