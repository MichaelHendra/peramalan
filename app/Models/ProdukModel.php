<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    use HasFactory;
    protected $table = 'tb_produk';
    protected $primaryKey = 'id_produk';
    public $incrementing = true;
    protected $fillable = ['id_produk', 'kode_produk', 'nama_produk', 'harga_jual'];
    protected $hidden = ['created_at', 'updated_at'];
    public $timestamps = false;
}


