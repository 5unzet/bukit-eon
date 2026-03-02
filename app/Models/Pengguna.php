<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Import Factory-nya
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\PenggunaFactory;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $fillable = ['nama', 'email', 'password', 'role'];
    

    // Tambahkan ini jika Laravel masih tidak menemukan Factory-nya
    protected static function newFactory() { return \Database\Factories\PenggunaFactory::new(); }
    
}
