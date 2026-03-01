<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
   protected $table = 'tiket';

protected $fillable = [
    'tanggal',
    'harga',
    'kuota',
    'kuota_tersedia'
];
}
