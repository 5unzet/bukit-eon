<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderHeader;
use App\Models\OrderDetail;

class OrderMakananController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal', date('Y-m-d'));
        $orders = OrderHeader::with('details')
            ->where('tanggal_order_header', $tanggal)
            ->orderByRaw("FIELD(status_order_header, 'INPUT', 'VALID', 'FINISH', 'PAID', 'VOID')")
            ->orderBy('waktu_order_header')
            ->get();
        return view('order-makanan', compact('orders', 'tanggal'));
    }

    public function validasi(Request $request)
    {
        $id = $request->input('id');
        $order = \App\Models\OrderHeader::findOrFail($id);
        if (strtolower($order->status_order_header) === 'input') {
            $order->status_order_header = 'VALID';
            $order->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Status tidak valid!'], 400);
    }

    public function finishItem(Request $request)
    {
        $id = $request->input('id');
        $item = \App\Models\OrderDetail::findOrFail($id);
        if (!in_array(strtolower($item->status_order_detail), ['finish','void'])) {
            $item->status_order_detail = 'FINISH';
            $item->save();
            // Cek jika semua item pada order sudah finish, update status header
            $order = $item->header;
            if ($order && strtolower($order->status_order_header) === 'valid') {
                $unfinished = $order->details()->whereNotIn('status_order_detail', ['FINISH','VOID'])->count();
                if ($unfinished === 0) {
                    $order->status_order_header = 'FINISH';
                    $order->save();
                }
            }
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Status tidak valid!'], 400);
    }

    public function bayar(Request $request)
    {
        $id = $request->input('id');
        $nominal = $request->input('nominal');
        $order = \App\Models\OrderHeader::findOrFail($id);
        if (strtolower($order->status_order_header) === 'finish') {
            if ($nominal < $order->total_order_header) {
                return response()->json(['success' => false, 'message' => 'Nominal bayar kurang dari tagihan!'], 400);
            }
            $order->bayar_order_header = $nominal;
            $order->kembali_order_header = $nominal - $order->total_order_header;
            $order->status_order_header = 'PAID';
            $order->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Status tidak valid!'], 400);
    }

    public function void(Request $request)
    {
        $id = $request->input('id');
        $order = \App\Models\OrderHeader::with('details')->findOrFail($id);
        if (strtolower($order->status_order_header) !== 'paid') {
            $order->status_order_header = 'VOID';
            $order->save();
            // Semua item makanan juga di-void
            foreach ($order->details as $item) {
                $item->status_order_detail = 'VOID';
                $item->save();
            }
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Order sudah paid, tidak bisa di-void!'], 400);
    }
}
