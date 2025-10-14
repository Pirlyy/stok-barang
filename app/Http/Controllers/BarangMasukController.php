<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BarangMasuk;
use Illuminate\Support\Facades\Storage;

class BarangMasukController extends Controller
{
    /**
     * 🔹 Tampilkan form barang masuk
     */
    public function indexBarangMasuk()
    {
        $produk = Product::orderBy('name', 'asc')->get();
        return view('barang.barang-masuk', compact('produk'));
    }

    /**
     * 🔹 Simpan data barang masuk (tambah stok / tambah produk baru)
     */
    public function storeBarangMasuk(Request $request)
    {
        $validated = $request->validate([
            'existing_product_id' => 'nullable|exists:products,id',
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
            'supplier' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        // Jika user memilih barang lama (update stok)
        if ($request->filled('existing_product_id')) {
            $product = Product::findOrFail($request->existing_product_id);
            $product->jumlah += $request->jumlah; // ✅ gunakan kolom jumlah
            $product->supplier = $request->supplier ?: $product->supplier;
            $product->save();
        } 
        // Jika barang baru (buat produk baru)
        else {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/barang'), $filename);
                $imagePath = $filename;
            }

            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'jumlah' => $request->jumlah,
                'description' => $request->description,
                'supplier' => $request->supplier,
                'image' => $imagePath,
            ]);
        }

        // Simpan riwayat barang masuk
        BarangMasuk::create([
            'product_id' => $product->id,
            'nama_barang'=>$product->name,
            'jumlah' => $request->jumlah,
            'supplier' => $request->supplier,
        ]);

        return redirect()->back()->with('success', 'Barang berhasil disimpan atau stok berhasil ditambahkan!');
    }

    /**
     * 🔹 Halaman Stok Barang (Card View)
     */
    public function indexStokBarang()
    {
        $stok = Product::orderBy('name', 'asc')->get();
        return view('stok-barang', compact('stok'));
    }

    /**
     * 🔹 Halaman Data Barang (CRUD View)
     */
    public function indexDataBarang()
    {
        $stok = Product::orderBy('id', 'desc')->get();
        return view('data-barang', compact('stok'));
    }

    /**
     * 🔹 Update Data Barang
     */
    public function updateDataBarang(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'supplier' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        // Update gambar jika ada
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path('uploads/barang/' . $product->image))) {
                unlink(public_path('uploads/barang/' . $product->image));
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/barang'), $filename);
            $product->image = $filename;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'jumlah' => $request->jumlah,
            'description' => $request->description,
            'supplier' => $request->supplier,
        ]);

        return redirect()->back()->with('success', 'Data barang berhasil diperbarui!');
    }

    /**
     * 🔹 Hapus Data Barang
     */
    public function destroyDataBarang($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && file_exists(public_path('uploads/barang/' . $product->image))) {
            unlink(public_path('uploads/barang/' . $product->image));
        }

        $product->delete();
        return redirect()->back()->with('success', 'Data barang berhasil dihapus!');
    }
}
