<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'tiket';
    protected $fillable = ['pengguna_id', 'kodeTiket', 'tanggalKunjungan', 'jumlah', 'totalHarga', 'status'];

    // Relasi balik ke Pengguna
    public function pengguna() {
        return $this->belongsTo(Pengguna::class);
    }

    protected static function newFactory() { return \Database\Factories\TiketFactory::new(); }
}