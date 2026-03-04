<h2>Dashboard User</h2>

<a href="{{ route('reservasi.index') }}" style="padding: 8px 16px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">
    Pesan Tiket Baru
</a>

<h3>Riwayat Reservasi</h3>

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>Tanggal</th>
            <th>Jumlah Orang</th>
            <th>Total Harga</th>
            <th>No. Antrian</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($reservasi as $r)
        <tr>
            {{-- Mengasumsikan 'tanggal' adalah objek Carbon --}}
            <td>{{ \Carbon\Carbon::parse($r->tiket->tanggal)->format('d M Y') }}</td>
            
            <td align="center">{{ $r->jumlah_orang }}</td>
            
            {{-- Format Rupiah --}}
            <td>Rp {{ number_format($r->total_harga, 0, ',', '.') }}</td>
            
            <td align="center"><strong>{{ $r->nomor_antrian }}</strong></td>
            
            <td>
                {{-- Menampilkan status dengan huruf kapital di depan --}}
                {{ ucfirst($r->status) }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" align="center">Belum ada riwayat reservasi.</td>
        </tr>
        @endforelse
    </tbody>
</table>