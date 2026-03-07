<?php

use Illuminate\Support\Facades\Route;


use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

use App\Models\TblUser;
Route::post('/login', function (Request $request) {
    $email = $request->input('username');
    $password = $request->input('password');
    // Login berdasarkan email_user dan pass_user
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
    return back()->with('swal', [
        'icon' => 'error',
        'title' => 'Login Gagal',
        'text' => 'Email atau password salah!',
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
    return view('ticketing');
});


use App\Http\Controllers\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index']);

use App\Models\Makan;
Route::get('/dashboard/makanan', function (Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    $makanans = Makan::where('status_makan', '<>', 'VOID')->with('user')->orderByDesc('updated_at_makan')->get();
    return view('makanan', compact('makanans'));
});

use App\Models\Iw;
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

use App\Models\TblTiket;
use App\Models\TblCust;
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

use App\Http\Controllers\OrderMakananController;
Route::get('/dashboard/order-makanan', [OrderMakananController::class, 'index'])->name('dashboard.order-makanan');
Route::post('/dashboard/order-makanan/validasi', [OrderMakananController::class, 'validasi'])->name('dashboard.order-makanan.validasi');
Route::post('/dashboard/order-makanan/finish-item', [OrderMakananController::class, 'finishItem'])->name('dashboard.order-makanan.finish-item');
Route::post('/dashboard/order-makanan/bayar', [OrderMakananController::class, 'bayar'])->name('dashboard.order-makanan.bayar');
Route::post('/dashboard/order-makanan/void', [OrderMakananController::class, 'void'])->name('dashboard.order-makanan.void');

//script crud mulai dari sini:
use Illuminate\Support\Str;
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

use Illuminate\Http\Response;
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
