<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    protected $fillable = [
        'nama_barang', 'jumlah', 'stok', 'satuan', 'supplier'
    ];
}
