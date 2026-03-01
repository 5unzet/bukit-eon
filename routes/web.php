<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('blades.home'); 
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\ReservasiController;

Route::middleware('auth')->group(function(){
    Route::get('/reservasi',[ReservasiController::class,'index'])->name('reservasi.index');
    Route::post('/reservasi',[ReservasiController::class,'store'])->name('reservasi.store');
});

Route::middleware('auth')->get('/dashboard-user', function () {
    $reservasi = Reservasi::where('user_id', Auth::id())->get();
    return view('dashboard-user', compact('reservasi'));
})->name('dashboard.user');

Route::middleware(['auth','admin'])->get('/dashboard-admin', [AdminController::class,'index'])->name('dashboard.admin');

Route::middleware(['auth','admin'])->get('/konfirmasi/{id}', function($id){
    $r = \App\Models\Reservasi::findOrFail($id);
    $r->status = 'dikonfirmasi';
    $r->save();
    return back();
})->name('admin.konfirmasi');

Route::middleware(['auth','admin'])->get('/statistik', [AdminController::class,'statistik'])->name('statistik');

require __DIR__.'/auth.php';
