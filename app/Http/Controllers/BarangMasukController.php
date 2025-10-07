<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BarangMasukController extends Controller
{
    // 🔹 Menampilkan form tambah barang masuk
    public function indexBarangMasuk()
    {
        return view('barang.barang-masuk');
    }

    // 🔹 Menyimpan barang baru ke tabel products
    public function storeBarangMasuk(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
            'supplier' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload gambar jika ada
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/barang'), $fileName);
        }

        // Simpan ke tabel products
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'jumlah' => $request->jumlah,
            'supplier' => $request->supplier,
            'description' => $request->description,
            'image' => $fileName,
        ]);

        return redirect()->route('barang-masuk')->with('success', 'Barang berhasil ditambahkan!');
    }

    // 🔹 Menampilkan stok barang (tanpa CRUD)
    public function indexStokBarang()
    {
        $stok = Product::all();
        return view('stok-barang', compact('stok'));
    }

    // 🔹 Menampilkan halaman data barang (CRUD)
    public function indexDataBarang()
    {
        $barang = Product::all();
        return view('data-barang', compact('barang'));
    }

    // 🔹 Update data barang
    public function updateDataBarang(Request $request, $id)
    {
        $barang = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:0',
            'supplier' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($barang->image && file_exists(public_path('uploads/barang/' . $barang->image))) {
                unlink(public_path('uploads/barang/' . $barang->image));
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/barang'), $fileName);
            $barang->image = $fileName;
        }

        $barang->update([
            'name' => $request->name,
            'price' => $request->price,
            'jumlah' => $request->jumlah,
            'supplier' => $request->supplier,
            'description' => $request->description,
            'image' => $barang->image,
        ]);

        return redirect()->route('data-barang')->with('success', 'Data barang berhasil diperbarui!');
    }

    // 🔹 Hapus data barang
    public function destroyDataBarang($id)
    {
        $barang = Product::findOrFail($id);

        // Hapus gambar dari folder
        if ($barang->image && file_exists(public_path('uploads/barang/' . $barang->image))) {
            unlink(public_path('uploads/barang/' . $barang->image));
        }

        $barang->delete();

        return redirect()->route('data-barang')->with('success', 'Data barang berhasil dihapus!');
    }
}
