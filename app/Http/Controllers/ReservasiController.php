<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function index()
    {
        $tiket = Tiket::where('kuota_tersedia','>',0)->get();
        return view('reservasi.index',compact('tiket'));
    }

    public function store(Request $request)
    {
        $tiket = Tiket::findOrFail($request->tiket_id);

        if($tiket->kuota_tersedia < $request->jumlah_orang){
            return back()->with('error','Kuota tidak cukup');
        }

        // FCFS: nomor antrian otomatis
        $nomor_antrian = Reservasi::where('tiket_id',$tiket->id)->count() + 1;

        $total = $request->jumlah_orang * $tiket->harga;

        Reservasi::create([
            'user_id' => Auth::id(),
            'tiket_id' => $tiket->id,
            'jumlah_orang' => $request->jumlah_orang,
            'total_harga' => $total,
            'nomor_antrian' => $nomor_antrian,
            'status' => 'pending'
        ]);

        $tiket->decrement('kuota_tersedia',$request->jumlah_orang);

        return back()->with('success','Reservasi berhasil');
    }
}