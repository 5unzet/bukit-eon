<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TiketController;

Route::middleware(['auth','admin'])->group(function(){
    Route::resource('tiket', TiketController::class);
});

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
        $tiket = Tiket::all();
        return view('tiket.index', compact('tiket'));
    }

    public function create()
    {
        return view('tiket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'harga' => 'required|integer',
            'kuota' => 'required|integer'
        ]);

        Tiket::create([
            'tanggal' => $request->tanggal,
            'harga' => $request->harga,
            'kuota' => $request->kuota,
            'kuota_tersedia' => $request->kuota
        ]);

        return redirect()->route('tiket.index');
    }

    public function edit(Tiket $tiket)
    {
        return view('tiket.edit', compact('tiket'));
    }

    public function update(Request $request, Tiket $tiket)
    {
        $tiket->update($request->all());
        return redirect()->route('tiket.index');
    }

    public function destroy(Tiket $tiket)
    {
        $tiket->delete();
        return redirect()->route('tiket.index');
    }
}
