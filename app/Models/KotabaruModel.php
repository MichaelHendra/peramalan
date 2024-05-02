<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KotabaruModel extends Model
{
    use HasFactory;
    protected $table = 'tb_kotabaru';
    protected $primaryKey = 'id_penjualan';
    public $incrementing = true;
    protected $fillable = ['kode_penjualan', 'id_produk', 'tanggal_penjualan', 'jumlah_penjualan'];
    protected $hidden = ['created_at', 'updated_at'];
    public $timestamps = false;
}


