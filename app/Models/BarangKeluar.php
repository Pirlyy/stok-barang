<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_barang', 'jumlah', 'penerima','product_id','nama_penerima'];

     public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
