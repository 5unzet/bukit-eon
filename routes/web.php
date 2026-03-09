<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use App\Models\TblCust;
use App\Models\Iw;
use App\Models\TblUser;
use App\Models\Makan;
use App\Models\TblTiket;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderMakananController;
Route::get('/dashboard/book/newTiket', function(Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    $customers = TblCust::where('status_cust', 'VALID')->orderBy('nama_cust')->get();
    $wisatas = Iw::where('status_iw', 'VALID')->orderBy('judul_iw')->get();
    return view('book.newTiket', compact('customers', 'wisatas'));
})->name('book.newTiket');

// Booking Tiket Baru
Route::post('/dashboard/book/newTiket', function(Request $request) {
    $validated = $request->validate([
        'id_user_tiket' => 'required|exists:tbl_cust,id_cust',
        'id_iw_tiket' => 'required|exists:tbl_iw,id_iw',
        'harga_tiket' => 'required|numeric|min:0',
        'qty_tiket' => 'required|integer|min:1',
        'total_tiket' => 'required|numeric|min:0',
        'tanggal' => 'required|date',
    ]);
    try {
        $tiket = new TblTiket();
        $tiket->tanggal_tiket = $validated['tanggal'];
        $tiket->id_user_tiket = $validated['id_user_tiket'];
        $tiket->id_iw_tiket = $validated['id_iw_tiket'];
        $tiket->harga_tiket = $validated['harga_tiket'];
        $tiket->qty_tiket = $validated['qty_tiket'];
        $tiket->total_tiket = $validated['total_tiket'];
        $tiket->status_tiket = 'VALID';
        $tiket->created_tiket = now('Asia/Jakarta');
        $tiket->resi_tiket = 'TKT-' . strtoupper(Str::random(8));
        $tiket->picc_tiket = session('user.id_user') ?? null;
        $tiket->save();
        return response()->json(['success' => true, 'message' => 'Tiket berhasil dipesan']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Gagal menyimpan tiket: ' . $e->getMessage()], 500);
    }
})->name('book.newTiket.store');

// Tambah Customer Baru (POST terpisah)
Route::post('/dashboard/book/add-cust', function(Request $request) {
    $validated = $request->validate([
        'nama_cust' => 'required',
        'no_hp_cust' => 'required|unique:tbl_cust,no_hp_cust',
        'email_cust' => 'nullable|email',
    ]);
    try {
        $cust = new TblCust();
        $cust->nama_cust = $validated['nama_cust'];
        $cust->no_hp_cust = $validated['no_hp_cust'];
        $cust->email_cust = $validated['email_cust'] ?? null;
        $cust->status_cust = 'VALID';
        $cust->created_cust = now('Asia/Jakarta');
        $cust->picc_cust = session('user.id_user') ?? null;
        $password = Str::random(6);
        $cust->pass_cust = $password;
        $cust->save();
        return response()->json([
            'success' => true,
            'message' => 'Konsumen berhasil ditambahkan',
            'cust' => $cust,
            'password' => $password
        ]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Gagal menambah konsumen: ' . $e->getMessage()], 500);
    }
});

// Order Makanan Baru

Route::get('/dashboard/book/newMakanan', function(Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    $customers = \App\Models\TblCust::where('status_cust', 'VALID')->orderBy('nama_cust')->get();
    $makanans = \App\Models\Makan::where('status_makan', 'VALID')->orderBy('nama_makan')->get();
    return view('book.newMakanan', compact('customers', 'makanans'));
})->name('book.newMakanan');

Route::post('/dashboard/book/newMakanan', function(Request $request) {
    $validated = $request->validate([
        'no_resi' => 'required',
        'tanggal_order' => 'required|date',
        'waktu_order' => 'required',
        'nama_pemesan' => 'required',
        'no_meja' => 'required',
        'grand_total' => 'required|numeric|min:0',
        'makanans' => 'required|array|min:1',
        'makanans.*.id_makanan' => 'required|exists:tbl_makan,id_makan',
        'makanans.*.qty' => 'required|integer|min:1',
        'makanans.*.harga' => 'required|numeric|min:0',
        'makanans.*.subtotal' => 'required|numeric|min:0',
        'makanans.*.catatan' => 'nullable|string',
    ]);
    try {
        // Simpan ke tbl_order_header
        $headerId = \DB::table('tbl_order_header')->insertGetId([
            'resi_order_header' => $validated['no_resi'],
            'tanggal_order_header' => $validated['tanggal_order'],
            'waktu_order_header' => $validated['waktu_order'],
            'nama_order_header' => $validated['nama_pemesan'],
            'meja_order_header' => $validated['no_meja'],
            'total_order_header' => $validated['grand_total'],
            'status_order_header' => 'INPUT',
            'created_order_header' => now('Asia/Jakarta'),
            'picc_order_header' => session('user.id_user') ?? null,
        ]);
        // Simpan detail makanan
        foreach ($validated['makanans'] as $item) {
            \DB::table('tbl_order_detail')->insert([
                'id_resi_order_detail' => $headerId,
                'resi_order_detail' => $validated['no_resi'],
                'id_makan_order_detail' => $item['id_makanan'],
                'nama_makan_order_detail' => \App\Models\Makan::find($item['id_makanan'])->nama_makan ?? '-',
                'qty_order_detail' => $item['qty'],
                'harga_order_detail' => $item['harga'],
                'catatan_order_detail' => $item['catatan'] ?? null,
                'status_order_detail' => 'INPUT',
                'created_order_detail' => now('Asia/Jakarta'),
                'updated_order_detail' => now('Asia/Jakarta'),
                'picc_order_detail' => session('user.id_user') ?? null,
            ]);
        }
        return redirect('/dashboard/order-makanan')->with('swal', [
            'icon' => 'success',
            'title' => 'Order makanan berhasil',
        ]);
    } catch (\Exception $e) {
        return back()->with('swal', [
            'icon' => 'error',
            'title' => 'Gagal order makanan',
            'text' => $e->getMessage(),
        ]);
    }
})->name('book.newMakanan.store');

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $email = $request->input('username');
    $password = $request->input('password');
    // Cek di tbl_user
    $user = TblUser::where('email_user', $email)
        ->where('pass_user', $password)
        ->first();
    if ($user) {
        if ($user->status_user !== 'VALID') {
            return back()->with('swal', [
                'icon' => 'error',
                'title' => 'Akun Ditangguhkan',
                'text' => 'Akun anda ditangguhkan, silahkan hubungi admin.',
            ]);
        }
        $request->session()->put('is_logged_in', true);
        $request->session()->put('user', [
            'id_user' => $user->id_user,
            'nama_user' => $user->nama_user,
            'email_user' => $user->email_user,
            'role_user' => $user->role_user,
            'status_user' => $user->status_user,
            'created_user' => $user->created_user,
        ]);
        return redirect('/booking')->with('swal', [
            'icon' => 'success',
            'title' => 'Login Berhasil',
            'text' => 'Selamat datang, ' . $user->nama_user . '!',
        ]);
    }
    // Jika tidak ditemukan di tbl_user, cek di tbl_cust (no_hp_cust/email_cust dan pass_cust)
    $cust = TblCust::where(function($q) use ($email) {
            $q->where('no_hp_cust', $email)
              ->orWhere('email_cust', $email);
        })
        ->where('pass_cust', $password)
        ->first();
    if ($cust) {
        if ($cust->status_cust !== 'VALID') {
            return back()->with('swal', [
                'icon' => 'error',
                'title' => 'Akun Ditangguhkan',
                'text' => 'Akun anda ditangguhkan, silahkan hubungi admin.',
            ]);
        }
        $request->session()->put('is_logged_in', true);
        $request->session()->put('user', [
            'id_user' => $cust->id_cust,
            'nama_user' => $cust->nama_cust,
            'email_user' => $cust->email_cust,
            'no_hp_user' => $cust->no_hp_cust,
            'role_user' => 'customer',
            'status_user' => $cust->status_cust,
            'created_user' => $cust->created_cust,
        ]);
        return redirect('/booking')->with('swal', [
            'icon' => 'success',
            'title' => 'Login Berhasil',
            'text' => 'Selamat datang, ' . $cust->nama_cust . '!',
        ]);
    }
    return back()->with('swal', [
        'icon' => 'error',
        'title' => 'Login Gagal',
        'text' => 'Email/No HP atau password salah!',
    ]);
});

Route::get('/logout', function (Request $request) {
    $request->session()->forget('is_logged_in');
    return redirect('/login');
})->name('logout');

Route::get('/booking', function (Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    return view('booking');
});


Route::get('/ticketing', function (Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    $wisatas = \App\Models\Iw::where('status_iw', 'VALID')->orderBy('judul_iw')->get();
    return view('ticketing', compact('wisatas'));
});

// Halaman pembayaran ticketing sederhana
Route::get('/ticketing/payment', function(Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    return view('ticketing-payment');
});


Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/dashboard/makanan', function (Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    $makanans = Makan::where('status_makan', '<>', 'VOID')->with('user')->orderByDesc('updated_at_makan')->get();
    return view('makanan', compact('makanans'));
});

// List wisata
Route::get('/dashboard/wisata', function (Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    $wisatas = Iw::where('status_iw', '<>', 'VOID')->with('user')->orderByDesc('updated_at_iw')->get();
    return view('wisata', compact('wisatas'));
});

Route::get('/dashboard/laporan/wisata', function (Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    return view('laporan-wisata');
});

Route::get('/dashboard/laporan/makanan', function (Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    return view('laporan-makanan');
});

Route::get('/dashboard/tiket', function (Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    $tanggal = $request->input('tanggal', now('Asia/Jakarta')->format('Y-m-d'));
    $tikets = TblTiket::with(['iw', 'cust'])
        ->whereDate('tanggal_tiket', $tanggal)
        ->orderByRaw("FIELD(status_tiket, 'VALID', 'PAID', 'VOID')")
        ->orderByDesc('tanggal_tiket')
        ->get();
    return view('tiket', compact('tanggal', 'tikets'));
});

Route::get('/dashboard/order-makanan', [OrderMakananController::class, 'index'])->name('dashboard.order-makanan');
Route::post('/dashboard/order-makanan/validasi', [OrderMakananController::class, 'validasi'])->name('dashboard.order-makanan.validasi');
Route::post('/dashboard/order-makanan/finish-item', [OrderMakananController::class, 'finishItem'])->name('dashboard.order-makanan.finish-item');
Route::post('/dashboard/order-makanan/bayar', [OrderMakananController::class, 'bayar'])->name('dashboard.order-makanan.bayar');
Route::post('/dashboard/order-makanan/void', [OrderMakananController::class, 'void'])->name('dashboard.order-makanan.void');

//script crud mulai dari sini:
// Tambah makanan
Route::post('/dashboard/makanan/tambah', function (Request $request) {
    $data = $request->validate([
        'nama_makan' => 'required',
        'harga_makan' => 'required|numeric',
        'deskripsi_makan' => 'nullable',
        'gambar_makan' => 'nullable',
    ]);
    $data['ketersediaan_makan'] = 'OPEN';
    $data['status_makan'] = 'VALID';
    $data['picu_makan'] = session('user.id_user') ?? 1;
    $data['created_at_makan'] = now('Asia/Jakarta');
    $data['updated_at_makan'] = now('Asia/Jakarta');
    // Handle upload gambar ke assets/makan
    try {
        if ($request->hasFile('gambar_makan')) {
            $dir = public_path('assets/makan');
            if (!file_exists($dir)) {
                if (!mkdir($dir, 0777, true) && !is_dir($dir)) {
                    throw new \Exception('Gagal membuat folder assets/makan');
                }
            }
            $file = $request->file('gambar_makan');
            $filename = uniqid('makan_') . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['gambar_makan'] = 'assets/makan/' . $filename;
        } else {
            $data['gambar_makan'] = null;
        }
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
    Makan::create($data);
    return response()->json(['success' => true]);
});

// Edit makanan
Route::post('/dashboard/makanan/edit/{id}', function (Request $request, $id) {
    $makan = Makan::findOrFail($id);
    $data = $request->validate([
        'nama_makan' => 'required',
        'harga_makan' => 'required|numeric',
        'deskripsi_makan' => 'nullable',
        'gambar_makan' => 'nullable',
    ]);
    $data['picu_makan'] = session('user.id_user') ?? 1;
    $data['updated_at_makan'] = now('Asia/Jakarta');
    try {
        if ($request->hasFile('gambar_makan')) {
            $dir = public_path('assets/makan');
            if (!file_exists($dir)) {
                if (!mkdir($dir, 0777, true) && !is_dir($dir)) {
                    throw new \Exception('Gagal membuat folder assets/makan');
                }
            }
            // Hapus file lama jika ada dan bukan url eksternal
            if ($makan->gambar_makan && !Str::startsWith($makan->gambar_makan, ['http://', 'https://'])) {
                $oldPath = public_path($makan->gambar_makan);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $file = $request->file('gambar_makan');
            $filename = uniqid('makan_') . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['gambar_makan'] = 'assets/makan/' . $filename;
        } else {
            // Tidak upload gambar baru, jangan ubah gambar_makan
            unset($data['gambar_makan']);
        }
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
    $makan->update($data);
    return response()->json(['success' => true]);
});

// Hapus makanan (set status VOID)
Route::post('/dashboard/makanan/hapus/{id}', function ($id) {
    $makan = Makan::findOrFail($id);
    $makan->update(['status_makan' => 'VOID', 'updated_at_makan' => now('Asia/Jakarta')]);
    return response()->json(['success' => true]);
});

// Toggle ketersediaan
Route::post('/dashboard/makanan/toggle-ready/{id}', function ($id) {
    $makan = Makan::findOrFail($id);
    $new = strtoupper($makan->ketersediaan_makan) === 'OPEN' ? 'CLOSE' : 'OPEN';
    $makan->update(['ketersediaan_makan' => $new, 'updated_at_makan' => now('Asia/Jakarta')]);
    return response()->json(['success' => true, 'ketersediaan_makan' => $new]);
});

// Tambah wisata
Route::post('/dashboard/wisata/tambah', function (Request $request) {
    try {
        $data = $request->validate([
            'judul_iw' => 'required',
            'deskripsi_iw' => 'nullable',
            'buka_iw' => 'nullable',
            'tutup_iw' => 'nullable',
            'tiket_iw' => 'nullable|numeric',
            'foto_iw' => 'nullable',
        ]);
        $data['status_iw'] = 'VALID';
        $data['picu_iw'] = session('user.id_user') ?? 1;
        $data['created_at_iw'] = now('Asia/Jakarta');
        $data['updated_at_iw'] = now('Asia/Jakarta');
        if ($request->hasFile('foto_iw')) {
            $dir = public_path('assets/wisata');
            if (!file_exists($dir)) {
                if (!mkdir($dir, 0777, true) && !is_dir($dir)) {
                    throw new \Exception('Gagal membuat folder assets/wisata');
                }
            }
            $file = $request->file('foto_iw');
            $filename = uniqid('iw_') . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['foto_iw'] = 'assets/wisata/' . $filename;
        } else {
            $data['foto_iw'] = null;
        }
        Iw::create($data);
        return response()->json(['success' => true]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage(), 'errors' => $e->errors()], 422);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
});

// Edit wisata
Route::post('/dashboard/wisata/edit/{id}', function (Request $request, $id) {
    $iw = Iw::findOrFail($id);
    $data = $request->validate([
        'judul_iw' => 'required',
        'deskripsi_iw' => 'nullable',
        'buka_iw' => 'nullable',
        'tutup_iw' => 'nullable',
        'tiket_iw' => 'nullable|numeric',
        'foto_iw' => 'nullable',
    ]);
    $data['picu_iw'] = session('user.id_user') ?? 1;
    $data['updated_at_iw'] = now('Asia/Jakarta');
    try {
        if ($request->hasFile('foto_iw')) {
            $dir = public_path('assets/wisata');
            if (!file_exists($dir)) {
                if (!mkdir($dir, 0777, true) && !is_dir($dir)) {
                    throw new \Exception('Gagal membuat folder assets/wisata');
                }
            }
            // Hapus file lama jika ada dan bukan url eksternal
            if ($iw->foto_iw && !Str::startsWith($iw->foto_iw, ['http://', 'https://'])) {
                $oldPath = public_path($iw->foto_iw);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $file = $request->file('foto_iw');
            $filename = uniqid('iw_') . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['foto_iw'] = 'assets/wisata/' . $filename;
        } else {
            unset($data['foto_iw']);
        }
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
    $iw->update($data);
    return response()->json(['success' => true]);
});

// Hapus wisata (set status VOID)
Route::post('/dashboard/wisata/hapus/{id}', function ($id) {
    $iw = Iw::findOrFail($id);
    $iw->update(['status_iw' => 'VOID', 'updated_at_iw' => now('Asia/Jakarta')]);
    return response()->json(['success' => true]);
});

Route::post('/dashboard/tiket/validasi', function(Request $request) {
    $id = $request->input('id');
    $userId = session('user.id_user') ?? 1;
    $tiket = TblTiket::find($id);
    if (!$tiket || $tiket->status_tiket !== 'VALID') {
        return response()->json(['success' => false, 'message' => 'Tiket tidak ditemukan atau status tidak valid!']);
    }
    $tiket->status_tiket = 'VALID'; // tetap VALID, jika ingin status lain bisa diubah
    $tiket->updated_tiket = now('Asia/Jakarta');
    $tiket->picu_tiket = $userId;
    $tiket->save();
    return response()->json(['success' => true]);
})->name('dashboard.tiket.validasi');
Route::post('/dashboard/tiket/bayar', function(Request $request) {
    $id = $request->input('id');
    $userId = session('user.id_user') ?? 1;
    $tiket = TblTiket::find($id);
    if (!$tiket || $tiket->status_tiket !== 'VALID') {
        return response()->json(['success' => false, 'message' => 'Tiket tidak ditemukan atau status tidak valid!']);
    }
    $tiket->status_tiket = 'PAID';
    $tiket->updated_tiket = now('Asia/Jakarta');
    $tiket->picu_tiket = $userId;
    $tiket->save();
    return response()->json(['success' => true]);
})->name('dashboard.tiket.bayar');
Route::post('/dashboard/tiket/void', function(Request $request) {
    $id = $request->input('id');
    $userId = session('user.id_user') ?? 1;
    $tiket = TblTiket::find($id);
    if (!$tiket || $tiket->status_tiket === 'PAID') {
        return response()->json(['success' => false, 'message' => 'Tiket tidak ditemukan atau sudah paid!']);
    }
    $tiket->status_tiket = 'VOID';
    $tiket->updated_tiket = now('Asia/Jakarta');
    $tiket->picu_tiket = $userId;
    $tiket->save();
    return response()->json(['success' => true]);
})->name('dashboard.tiket.void');
Route::get('/dashboard/tiket/cetak/{id}', function($id) {
    return new Response('Cetak tiket #'.$id, 200);
})->name('dashboard.tiket.cetak');

// Simpan pesanan tiket (AJAX)
Route::post('/ticketing/order', function(Request $request) {
    $data = $request->all();
    // Validasi sederhana
    if (!isset($data['resi_tiket']) || !$data['resi_tiket']) {
        return response()->json(['error' => 'Resi tiket wajib diisi'], 400);
    }
    // Cek duplikat
    $exists = DB::table('tbl_tiket')->where('resi_tiket', $data['resi_tiket'])->exists();
    if ($exists) {
        return response()->json(['error' => 'Resi sudah ada'], 409);
    }
    // Simpan ke tbl_tiket (field sesuai migration)
    DB::table('tbl_tiket')->insert([
        'resi_tiket'      => $data['resi_tiket'],
        'tanggal_tiket'   => $data['tanggal'] ?? now('Asia/Jakarta')->toDateString(),
        'id_user_tiket'   => session('user.id_user') ?? null,
        'id_iw_tiket'     => $data['id_iw'],
        'harga_tiket'     => $data['harga_tiket'],
        'qty_tiket'       => $data['qty'],
        'total_tiket'     => $data['total_harga'],
        'status_tiket'    => 'VALID',
        'created_tiket'   => now('Asia/Jakarta'),
        'picc_tiket'      => null,
        'updated_tiket'   => now('Asia/Jakarta'),
        'picu_tiket'      => null,
    ]);
    return response()->json(['success' => true]);
});

// Ambil data pesanan tiket by resi (AJAX)
Route::get('/ticketing/order/{resi}', function($resi) {
    $order = DB::table('tbl_tiket')
        ->leftJoin('tbl_iw', 'tbl_tiket.id_iw_tiket', '=', 'tbl_iw.id_iw')
        ->where('tbl_tiket.resi_tiket', $resi)
        ->select('tbl_tiket.*', 'tbl_iw.judul_iw')
        ->first();
    if (!$order) {
        return response()->json(['error' => 'Pesanan tidak ditemukan'], 404);
    }
    return response()->json($order);
});

// Riwayat Pesanan Tiket untuk customer
Route::get('/history', function(Request $request) {
    $user = $request->session()->get('user');
    if (!$user || ($user['role_user'] ?? null) !== 'customer') {
        return redirect('/login');
    }
    $bulan = $request->get('bulan');
    $tahun = $request->get('tahun');
    // Tiket
    $query = TblTiket::where('id_user_tiket', $user['id_user'] ?? 0)
        ->leftJoin('tbl_iw', 'tbl_tiket.id_iw_tiket', '=', 'tbl_iw.id_iw');
    if ($bulan) {
        $query->whereMonth('tbl_tiket.tanggal_tiket', $bulan);
    }
    if ($tahun) {
        $query->whereYear('tbl_tiket.tanggal_tiket', $tahun);
    }
    $orders = $query->orderByDesc('tbl_tiket.created_tiket')
        ->select('tbl_tiket.*', 'tbl_iw.judul_iw')
        ->get();
    // Makanan
    $makananQuery = DB::table('tbl_order_header')
        ->where('nama_order_header', $user['nama_user'] ?? '-')
        ->where('status_order_header', '<>', 'VOID');
    if ($bulan) {
        $makananQuery->whereMonth('tanggal_order_header', $bulan);
    }
    if ($tahun) {
        $makananQuery->whereYear('tanggal_order_header', $tahun);
    }
    $makanan_orders = $makananQuery->orderByDesc('created_order_header')->get();
    return view('history', compact('orders', 'makanan_orders'));
});

// Void pesanan tiket (batal) by resi
Route::post('/ticketing/void', function(Request $request) {
    $resi = $request->input('resi');
    if (!$resi) {
        return response()->json(['success' => false, 'message' => 'Resi tidak ditemukan']);
    }
    $affected = DB::table('tbl_tiket')
        ->where('resi_tiket', $resi)
        ->where('status_tiket', 'VALID')
        ->update([
            'status_tiket' => 'VOID',
            'updated_tiket' => now('Asia/Jakarta'),
        ]);
    if ($affected) {
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan atau sudah tidak valid']);
    }
});

// Order Makanan dari halaman booking (keranjang)
Route::post('/booking', function(Request $request) {
    $data = $request->all();
    // Validasi manual karena data JSON
    $request->validate([
        'resi_order' => 'required',
        'tanggal_order' => 'required|date',
        'waktu_order' => 'required',
        'meja_order' => 'required',
        'grand_total' => 'required|numeric|min:0',
        'makanans' => 'required|array|min:1',
        'makanans.*.id_makanan' => 'required|exists:tbl_makan,id_makan',
        'makanans.*.qty' => 'required|integer|min:1',
        'makanans.*.harga' => 'required|numeric|min:0',
        'makanans.*.subtotal' => 'required|numeric|min:0',
        'makanans.*.catatan' => 'nullable|string',
    ]);
    try {
        $headerId = \DB::table('tbl_order_header')->insertGetId([
            'resi_order_header' => $data['resi_order'],
            'tanggal_order_header' => $data['tanggal_order'],
            'waktu_order_header' => $data['waktu_order'],
            'nama_order_header' => session('user.nama_user') ?? '-',
            'meja_order_header' => $data['meja_order'],
            'total_order_header' => $data['grand_total'],
            'status_order_header' => 'INPUT',
            'created_order_header' => now('Asia/Jakarta'),
            'picc_order_header' => null,
        ]);
        foreach ($data['makanans'] as $item) {
            \DB::table('tbl_order_detail')->insert([
                'id_resi_order_detail' => $headerId,
                'resi_order_detail' => $data['resi_order'],
                'id_makan_order_detail' => $item['id_makanan'],
                'nama_makan_order_detail' => \App\Models\Makan::find($item['id_makanan'])->nama_makan ?? '-',
                'qty_order_detail' => $item['qty'],
                'harga_order_detail' => $item['harga'],
                'catatan_order_detail' => $item['catatan'] ?? null,
                'status_order_detail' => 'INPUT',
                'created_order_detail' => now('Asia/Jakarta'),
                'updated_order_detail' => now('Asia/Jakarta'),
                'picc_order_detail' => null,
            ]);
        }
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
});

// Edit Profil Sederhana
Route::get('/profil', function(Request $request) {
    $user = $request->session()->get('user');
    if (!$user) return redirect('/login');
    $isCustomer = ($user['role_user'] ?? null) === 'customer';
    if ($isCustomer) {
        $cust = \App\Models\TblCust::find($user['id_user']);
        return view('profil', [
            'isCustomer' => true,
            'user' => $cust
        ]);
    } else {
        $admin = \App\Models\TblUser::find($user['id_user']);
        return view('profil', [
            'isCustomer' => false,
            'user' => $admin
        ]);
    }
});

Route::post('/profil', function(Request $request) {
    $user = $request->session()->get('user');
    if (!$user) return redirect('/login');
    $isCustomer = ($user['role_user'] ?? null) === 'customer';
    if ($isCustomer) {
        $cust = \App\Models\TblCust::find($user['id_user']);
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'nullable|email',
            'no_hp' => 'required',
            'pass' => 'nullable',
        ]);
        $cust->nama_cust = $validated['nama'];
        $cust->email_cust = $validated['email'];
        $cust->no_hp_cust = $validated['no_hp'];
        if($validated['pass']) $cust->pass_cust = $validated['pass'];
        $cust->updated_cust = now('Asia/Jakarta');
        $cust->picu_cust = null;
        try {
            $cust->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $msg = 'Terjadi duplikat data.';
            if(str_contains($e->getMessage(), 'no_hp_cust')) {
                $msg = 'Nomor HP sudah terdaftar.';
            } else if(str_contains($e->getMessage(), 'email_cust')) {
                $msg = 'Email sudah terdaftar.';
            }
            return back()->with('swal', ['icon'=>'error','title'=>'Gagal update profil','text'=>$msg]);
        }
        // Update session jika nama/email/no_hp berubah
        $request->session()->put('user.nama_user', $cust->nama_cust);
        $request->session()->put('user.email_user', $cust->email_cust);
        $request->session()->put('user.no_hp_user', $cust->no_hp_cust);
        return back()->with('swal', ['icon'=>'success','title'=>'Profil berhasil diupdate']);
    } else {
        $admin = \App\Models\TblUser::find($user['id_user']);
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pass' => 'nullable',
        ]);
        $admin->nama_user = $validated['nama'];
        $admin->email_user = $validated['email'];
        if($validated['pass']) $admin->pass_user = $validated['pass'];
        $admin->updated_user = now('Asia/Jakarta');
        $admin->picu_user = $user['id_user'];
        $admin->save();
        // Update session jika nama/email berubah
        $request->session()->put('user.nama_user', $admin->nama_user);
        $request->session()->put('user.email_user', $admin->email_user);
        return back()->with('swal', ['icon'=>'success','title'=>'Profil berhasil diupdate']);
    }
});

// Dashboard versi profil
Route::get('/dashboard/profil', function(Request $request) {
    $user = $request->session()->get('user');
    if (!$user) return redirect('/login');
    $isCustomer = ($user['role_user'] ?? null) === 'customer';
    if ($isCustomer) {
        $cust = \App\Models\TblCust::find($user['id_user']);
        return view('dashboard.profil', [
            'user' => $cust
        ]);
    } else {
        $admin = \App\Models\TblUser::find($user['id_user']);
        return view('dashboard.profil', [
            'user' => $admin
        ]);
    }
});

Route::post('/dashboard/profil', function(Request $request) {
    $user = $request->session()->get('user');
    if (!$user) return redirect('/login');
    $isCustomer = ($user['role_user'] ?? null) === 'customer';
    if ($isCustomer) {
        $cust = \App\Models\TblCust::find($user['id_user']);
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'nullable|email',
            'no_hp' => 'required',
            'pass' => 'nullable',
        ]);
        $cust->nama_cust = $validated['nama'];
        $cust->email_cust = $validated['email'];
        $cust->no_hp_cust = $validated['no_hp'];
        if($validated['pass']) $cust->pass_cust = $validated['pass'];
        $cust->updated_cust = now('Asia/Jakarta');
        $cust->picu_cust = null;
        try {
            $cust->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $msg = 'Terjadi duplikat data.';
            if(str_contains($e->getMessage(), 'no_hp_cust')) {
                $msg = 'Nomor HP sudah terdaftar.';
            } else if(str_contains($e->getMessage(), 'email_cust')) {
                $msg = 'Email sudah terdaftar.';
            }
            return back()->with('swal', ['icon'=>'error','title'=>'Gagal update profil','text'=>$msg]);
        }
        // Update session jika nama/email/no_hp berubah
        $request->session()->put('user.nama_user', $cust->nama_cust);
        $request->session()->put('user.email_user', $cust->email_cust);
        $request->session()->put('user.no_hp_user', $cust->no_hp_cust);
        return back()->with('swal', ['icon'=>'success','title'=>'Profil berhasil diupdate']);
    } else {
        $admin = \App\Models\TblUser::find($user['id_user']);
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'nullable|email',
            'pass' => 'nullable',
        ]);
        $admin->nama_user = $validated['nama'];
        $admin->email_user = $validated['email'];
        if($validated['pass']) $admin->pass_user = $validated['pass'];
        $admin->updated_user = now('Asia/Jakarta');
        $admin->picu_user = $user['id_user'];
        try {
            $admin->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $msg = 'Terjadi duplikat data.';
            if(str_contains($e->getMessage(), 'email_user')) {
                $msg = 'Email sudah terdaftar.';
            }
            return back()->with('swal', ['icon'=>'error','title'=>'Gagal update profil','text'=>$msg]);
        }
        // Update session jika nama/email berubah
        $request->session()->put('user.nama_user', $admin->nama_user);
        $request->session()->put('user.email_user', $admin->email_user);
        return back()->with('swal', ['icon'=>'success','title'=>'Profil berhasil diupdate']);
    }
});
