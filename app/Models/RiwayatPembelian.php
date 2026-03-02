<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPembelian extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pembelian';
    protected $fillable = ['pengguna_id', 'tiket_id', 'tanggal'];
}