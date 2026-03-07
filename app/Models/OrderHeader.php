<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHeader extends Model
{
    use HasFactory;
    protected $table = 'tbl_order_header';
    protected $primaryKey = 'id_order_header';
    public $timestamps = false;
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'id_resi_order_detail', 'id_order_header');
    }
}
