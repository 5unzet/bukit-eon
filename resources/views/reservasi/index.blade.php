<h2>Reservasi Tiket</h2>

@if(session('error'))
<p style="color:red">{{ session('error') }}</p>
@endif

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

@foreach($tiket as $t)
<form method="POST" action="{{ route('reservasi.store') }}">
@csrf
<input type="hidden" name="tiket_id" value="{{ $t->id }}">
Tanggal: {{ $t->tanggal }} <br>
Harga: {{ $t->harga }} <br>
Sisa Kuota: {{ $t->kuota_tersedia }} <br>
Jumlah Orang: <input type="number" name="jumlah_orang">
<button type="submit">Pesan</button>
<hr>
</form>
@endforeach