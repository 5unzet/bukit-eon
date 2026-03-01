<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $reservasi = Reservasi::with(['tiket','user'])->get();
        return view('dashboard-admin', compact('reservasi'));
    }

    public function statistik()
{
    $data = DB::table('reservasi')
        ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('SUM(total_harga) as total'))
        ->groupBy('bulan')
        ->get();

    return view('statistik', compact('data'));
}
}