<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HitungDetail extends Model
{
    use HasFactory;
    protected $table = 'perhitunganholtwinters';
    protected $fillable = ['id_perhitungan','id_produk','tanggal_penjualan','value','level','trend','season','prediction'];
    public $timestamps = false;

    public function dataProduk() {
        return $this->belongsTo(ProdukModel::class, 'id_produk')->withDefault([
            'id_produk' => 'tidak ada',
        ]);
    }
}
