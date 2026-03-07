<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblTiket extends Model
{
    protected $table = 'tbl_tiket';
    protected $primaryKey = 'id_tiket';
    public $timestamps = false;
    protected $guarded = [];

    public function iw() {
        return $this->belongsTo(Iw::class, 'id_iw_tiket', 'id_iw');
    }
    public function cust() {
        return $this->belongsTo(TblCust::class, 'id_user_tiket', 'id_cust');
    }
    public function piccUser() {
        return $this->belongsTo(TblUser::class, 'picc_tiket', 'id_user');
    }
    public function picuUser() {
        return $this->belongsTo(TblUser::class, 'picc_tiket', 'id_user');
    }
}
