<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanWisata extends Model
{
    protected $table = 'tbl_laporan_wisata';
    protected $primaryKey = 'id_laporan';
    public $timestamps = false;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(TblUser::class, 'picu_laporan', 'id_user');
    }
}
