<h2>Dashboard Admin</h2>

<table border="1">
<tr>
    <th>User</th>
    <th>Tanggal</th>
    <th>Jumlah</th>
    <th>Total</th>
    <th>Antrian</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($reservasi as $r)
<tr>
    <td>{{ $r->user->name }}</td>
    <td>{{ $r->tiket->tanggal }}</td>
    <td>{{ $r->jumlah_orang }}</td>
    <td>{{ $r->total_harga }}</td>
    <td>{{ $r->nomor_antrian }}</td>
    <td>{{ $r->status }}</td>
    <td>
        <a href="{{ route('admin.konfirmasi',$r->id) }}">Konfirmasi</a>
    </td>
</tr>
@endforeach
</table>