<h2>Data Tiket</h2>

<a href="{{ route('tiket.create') }}">Tambah Tiket</a>

<table border="1">
<tr>
    <th>Tanggal</th>
    <th>Harga</th>
    <th>Kuota</th>
    <th>Sisa</th>
    <th>Aksi</th>
</tr>

@foreach($tiket as $t)
<tr>
    <td>{{ $t->tanggal }}</td>
    <td>{{ $t->harga }}</td>
    <td>{{ $t->kuota }}</td>
    <td>{{ $t->kuota_tersedia }}</td>
    <td>
        <a href="{{ route('tiket.edit',$t->id) }}">Edit</a>
        <form action="{{ route('tiket.destroy',$t->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</table>