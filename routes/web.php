
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
