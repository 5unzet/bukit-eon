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


Route::get('/dashboard', function (Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    return view('dashboard');
});

use App\Models\Makan;
Route::get('/dashboard/makanan', function (Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    $makanans = Makan::where('status_makan', '<>', 'VOID')->with('user')->orderByDesc('updated_at_makan')->get();
    return view('makanan', compact('makanans'));
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
Route::get('/dashboard/orders', function (Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    return view('orders');
});

Route::get('/dashboard/wisata', function (Request $request) {
    if (!$request->session()->get('is_logged_in')) {
        return redirect('/login');
    }
    return view('wisata');
});

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
    \App\Models\Makan::create($data);
    return response()->json(['success' => true]);
});

// Edit makanan
Route::post('/dashboard/makanan/edit/{id}', function (Request $request, $id) {
    $makan = \App\Models\Makan::findOrFail($id);
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
    $makan = \App\Models\Makan::findOrFail($id);
    $makan->update(['status_makan' => 'VOID', 'updated_at_makan' => now('Asia/Jakarta')]);
    return response()->json(['success' => true]);
});

// Toggle ketersediaan
Route::post('/dashboard/makanan/toggle-ready/{id}', function ($id) {
    $makan = \App\Models\Makan::findOrFail($id);
    $new = strtoupper($makan->ketersediaan_makan) === 'OPEN' ? 'CLOSE' : 'OPEN';
    $makan->update(['ketersediaan_makan' => $new, 'updated_at_makan' => now('Asia/Jakarta')]);
    return response()->json(['success' => true, 'ketersediaan_makan' => $new]);
});
