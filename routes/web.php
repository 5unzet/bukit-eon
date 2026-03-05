
<?php

use Illuminate\Support\Facades\Route;


use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');
    // Contoh login sederhana (username: admin, password: admin123)
    if ($username === 'admin' && $password === 'admin123') {
        $request->session()->put('is_logged_in', true);
        return redirect('/booking');
    }
    return back()->withErrors(['login' => 'Username atau password salah!']);
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
