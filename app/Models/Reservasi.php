<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Reservasi extends Model
{
   protected $table = 'reservasi';

protected $fillable = [
    'user_id',
    'tiket_id',
    'jumlah_orang',
    'total_harga',
    'nomor_antrian',
    'status'
];

    public function tiket()
{
    return $this->belongsTo(Tiket::class, 'tiket_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
