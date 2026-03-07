<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Makan extends Model
{
    protected $table = 'tbl_makan';
    protected $primaryKey = 'id_makan';
    public $timestamps = false;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(TblUser::class, 'picu_makan', 'id_user');
    }
}
