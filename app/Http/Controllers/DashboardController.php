<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderHeader;
use App\Models\OrderDetail;
use App\Models\TblTiket;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $today = now('Asia/Jakarta')->format('Y-m-d');
        $orderAktif = OrderHeader::whereDate('tanggal_order_header', $today)
            ->whereIn('status_order_header', ['INPUT', 'VALID', 'FINISH'])
            ->whereNotIn('status_order_header', ['PAID', 'VOID'])
            ->count();
        $orderSelesai = OrderHeader::whereDate('tanggal_order_header', $today)
            ->where('status_order_header', 'FINISH')
            ->count();
        $tiketTerjual = TblTiket::whereDate('tanggal_tiket', $today)
            ->where('status_tiket', 'PAID')
            ->sum('qty_tiket');
        $nominalOrder = OrderHeader::whereDate('tanggal_order_header', $today)
            ->where('status_order_header', 'PAID')
            ->sum('total_order_header');
        $nominalTiket = TblTiket::whereDate('tanggal_tiket', $today)
            ->where('status_tiket', 'PAID')
            ->sum('total_tiket');
        $nominalDidapatkan = $nominalOrder + $nominalTiket;
        $makananHarusDibuat = OrderDetail::with(['header'])
            ->whereHas('header', function($q) use ($today) {
                $q->whereDate('tanggal_order_header', $today);
            })
            ->whereNotIn('status_order_detail', ['FINISH', 'VOID'])
            ->get();
        $days = collect();
        for ($i = 9; $i >= 0; $i--) {
            $days->push(now('Asia/Jakarta')->subDays($i)->format('Y-m-d'));
        }
        $chart = [
            'labels' => [],
            'order_selesai' => [],
            'tiket_terjual' => [],
            'nominal' => [],
        ];
        foreach ($days as $tgl) {
            $chart['labels'][] = date('j M', strtotime($tgl));
            $chart['order_selesai'][] = OrderHeader::whereDate('tanggal_order_header', $tgl)
                ->where('status_order_header', 'FINISH')->count();
            $chart['tiket_terjual'][] = TblTiket::whereDate('tanggal_tiket', $tgl)
                ->where('status_tiket', 'PAID')->sum('qty_tiket');
            $nominalOrder = OrderHeader::whereDate('tanggal_order_header', $tgl)
                ->where('status_order_header', 'PAID')->sum('total_order_header');
            $nominalTiket = TblTiket::whereDate('tanggal_tiket', $tgl)
                ->where('status_tiket', 'PAID')->sum('total_tiket');
            $chart['nominal'][] = $nominalOrder + $nominalTiket;
        }
        return view('dashboard', compact(
            'orderAktif', 'orderSelesai', 'tiketTerjual', 'nominalDidapatkan', 'makananHarusDibuat', 'chart'
        ));
    }
}
