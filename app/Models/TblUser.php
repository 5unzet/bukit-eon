<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblUser extends Model
{
    use HasFactory;
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    public $timestamps = true;

    protected $fillable = [
        'nama_user',
        'email_user',
        'pass_user',
        'role_user',
        'status_user',
        'created_user',
    ];

    protected $hidden = [
        'pass_user',
    ];
}
