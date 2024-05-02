<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hitung extends Model
{
    use HasFactory;
    protected $table = 'tb_perhitungan';
    protected $fillable = ['id_perhitungan','tanggal','alpha','beta','gamma','jumlah_periode','mape','akurasi'];
    public $timestamps = false;
}

