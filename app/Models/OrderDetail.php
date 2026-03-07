<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'tbl_order_detail';
    protected $primaryKey = 'id_order_detail';
    public $timestamps = false;
    protected $guarded = [];

    public function header()
    {
        return $this->belongsTo(OrderHeader::class, 'id_resi_order_detail', 'id_order_header');
    }
}
