<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    // 🔹 API: Tampilkan semua barang dalam format JSON
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    // 🔹 Tampilkan halaman form barang masuk
    public function indexBarangMasuk()
    {
        return view('barang.barang-masuk'); // form untuk tambah barang baru
    }

    // 🔹 Simpan barang baru (barang masuk)
    public function storeBarangMasuk(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'supplier'    => 'required|string|max:255',
            'jumlah'      => 'required|integer|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $validated['tanggal'] = now();

        // Simpan barang baru ke products
        $product = Product::create($validated);

        // Simpan juga di barang_masuks untuk riwayat
        BarangMasuk::create([
            'product_id'  => $product->id,
            'nama_barang' => $product->name,
            'jumlah'      => $product->jumlah,
            'supplier'    => $product->supplier,
            'tanggal'     => $product->tanggal,
        ]);

        return redirect()->route('barang-masuk')
                         ->with('success', 'Barang baru berhasil ditambahkan!');
    }

    // 🔹 Tampilkan semua data barang
    public function indexDataBarang()
    {
        $barang = Product::all();
        return view('data-barang', compact('barang'));
    }

    // 🔹 Update data barang
    public function updateDataBarang(Request $request, $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'supplier'    => 'required|string|max:255',
            'jumlah'      => 'required|integer|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $barang = Product::findOrFail($id);
        $barang->update($validated);

        return redirect()->route('data-barang')
                         ->with('success', 'Data barang berhasil diperbarui!');
    }

    // 🔹 Hapus data barang
    public function destroyDataBarang($id)
    {
        $barang = Product::findOrFail($id);
        $barang->delete();

        return redirect()->route('data-barang')
                         ->with('success', 'Data barang berhasil dihapus!');
    }

    // 🔹 Hitung total barang masuk (untuk chart)
    public function totalBarangMasuk()
    {
        return BarangMasuk::sum('jumlah');
    }
}
