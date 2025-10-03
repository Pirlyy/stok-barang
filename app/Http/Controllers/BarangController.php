<?php

namespace App\Http\Controllers;

use App\Models\Product; // kalau modelnya masih pakai "Product", biarkan ini
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // 🔹 Tampilkan semua barang
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    // 🔹 Tambah barang baru
    // Tampilkan halaman barang masuk
public function indexBarangMasuk()
{
    $barang = Product::all();
    return view('barang.barang-masuk', compact('barang'));
}

// Simpan barang masuk via form
public function storeBarangMasuk(Request $request)
{
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'supplier'    => 'required|string|max:225',
        'jumlah'      => 'required|integer|min:0',
        'description' => 'required|string|max:255',
    ]);

    $validated['tanggal'] = now();

    Product::create($validated);

    return redirect()->route('barang-masuk')->with('success', 'Barang masuk berhasil ditambahkan!');
}

// Tampilkan halaman barang keluar
public function indexBarangKeluar()
{
    $barang = Product::all();
    return view('barang.barang-keluar', compact('barang'));
}

// Simpan barang keluar via form
public function storeBarangKeluar(Request $request)
{
    $validated = $request->validate([
        'name'     => 'required|string|max:255',
        'jumlah'   => 'required|integer|min:1',
    ]);

    // logika barang keluar, misalnya kurangi stok
    $barang = Product::findOrFail($request->id);
    $barang->jumlah -= $validated['jumlah'];
    $barang->save();

    return redirect()->route('barang-keluar')->with('success', 'Barang keluar berhasil dicatat!');
}

// BarangController.php
public function indexDataBarang()
{
    $barang = Product::all(); // ambil semua data barang dari tabel products
    return view('data-barang', compact('barang'));
}

public function updateDataBarang(Request $request, $id)
{
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'supplier'    => 'required|string|max:225',
        'jumlah'      => 'required|integer|min:0',
        'description' => 'required|string|max:255',
    ]);

    $barang = Product::findOrFail($id);
    $barang->update($validated);

    return redirect()->route('data-barang')->with('success', 'Data barang berhasil diperbarui!');
}

// Hapus data barang
public function destroyDataBarang($id)
{
    $barang = Product::findOrFail($id);
    $barang->delete();

    return redirect()->route('data-barang')->with('success', 'Data barang berhasil dihapus!');
}

}