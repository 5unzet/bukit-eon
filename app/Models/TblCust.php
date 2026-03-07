<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblCust extends Model
{
    protected $table = 'tbl_cust';
    protected $primaryKey = 'id_cust';
    public $timestamps = false;
    protected $guarded = [];
}
