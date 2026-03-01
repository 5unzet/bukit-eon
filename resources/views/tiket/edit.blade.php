<h2>Edit Tiket</h2>

<form method="POST" action="{{ route('tiket.update',$tiket->id) }}">
@csrf
@method('PUT')
Tanggal: <input type="date" name="tanggal" value="{{ $tiket->tanggal }}"><br>
Harga: <input type="number" name="harga" value="{{ $tiket->harga }}"><br>
Kuota: <input type="number" name="kuota" value="{{ $tiket->kuota }}"><br>
<button type="submit">Update</button>
</form>