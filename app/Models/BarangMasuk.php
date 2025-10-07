<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'nama_barang',
        'jumlah',
        'supplier',
    ];

    // 🔹 Relasi ke tabel products
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
