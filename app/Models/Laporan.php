<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $fillable = ['tanggal', 'jumlahKunjungan', 'jumlahTiket', 'jumlahMakanan'];

    protected static function newFactory() { return \Database\Factories\LaporanFactory::new(); }
}