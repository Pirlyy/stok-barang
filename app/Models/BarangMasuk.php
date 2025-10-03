<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $fillable = [
        'nama_barang', 'jumlah', 'supplier', 'product_id', 'tanggal'
    ];
}
