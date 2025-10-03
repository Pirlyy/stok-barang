<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\BarangKeluar;

class BarangKeluarController extends Controller
{
    // Tampilkan halaman barang keluar
    public function index()
    {
        $barang = Product::all();
        return view('barang.barang-keluar', compact('barang'));
    }

    // Simpan data barang keluar
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id'     => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
            'nama_penerima'=>'required|string|max:255',
        ]);

        $barang = Product::findOrFail($validated['id']);

        // cek stok
        if ($barang->jumlah < $validated['jumlah']) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        // kurangi stok
        $barang->jumlah -= $validated['jumlah'];
        $barang->save();

        BarangKeluar::create([
    'product_id'    => $barang->id,
    'nama_barang'   => $barang->name, // snapshot nama barang
    'nama_penerima' => $validated['nama_penerima'],
    'jumlah'        => $validated['jumlah'],
]);


        return redirect()->route('barang-keluar')
                         ->with('success', 'Barang keluar berhasil dicatat!');
    }
}
