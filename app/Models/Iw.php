<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iw extends Model
{
    protected $table = 'tbl_iw';
    protected $primaryKey = 'id_iw';
    public $timestamps = false;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(TblUser::class, 'picu_iw', 'id_user');
    }
}
