<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    use HasFactory;

    protected $table = 'makanan';
    protected $fillable = ['nama', 'harga', 'stok'];

    protected static function newFactory() 
    { 
        return \Database\Factories\MakananFactory::new(); 
    }
}
