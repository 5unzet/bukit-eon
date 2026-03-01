<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiWisata extends Model
{
    use HasFactory;

    protected $table = 'informasi_wisata';
    protected $fillable = ['judul', 'deskripsi', 'jamBuka', 'foto'];
}