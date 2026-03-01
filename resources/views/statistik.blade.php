<h2>Statistik Bulanan</h2>

<table border="1">
<tr>
    <th>Bulan</th>
    <th>Total Pendapatan</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->bulan }}</td>
    <td>{{ $d->total }}</td>
</tr>
@endforeach
</table>