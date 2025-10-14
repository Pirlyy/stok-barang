<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class BarangKeluarController extends Controller
{
    // 🔹 Tampilkan halaman barang keluar (termasuk retur)
    public function index()
    {
        $barang = Product::all();
        return view('barang.barang-keluar', compact('barang'));
    }

    // 🔹 Simpan data barang keluar / retur
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id'     => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
            'nama_penerima' => 'required|string|max:255',
            'tipe_transaksi' => 'required|in:keluar,retur', // ⬅️ keluar = ke konsumen, retur = ke supplier
        ]);

        $barang = Product::findOrFail($validated['id']);

        // 🔹 Jika transaksi adalah barang keluar (ke konsumen)
        if ($validated['tipe_transaksi'] === 'keluar') {
            if ($barang->jumlah < $validated['jumlah']) {
                return back()->with('error', 'Stok tidak mencukupi!');
            }

            $barang->jumlah -= $validated['jumlah'];
            $barang->save();

            BarangKeluar::create([
                'product_id'    => $barang->id,
                'nama_barang'   => $barang->name,
                'nama_penerima' => $validated['nama_penerima'],
                'jumlah'        => $validated['jumlah'],
                'tipe_transaksi'=> 'keluar',
            ]);

            return redirect()->route('barang-keluar')
                ->with('success', 'Barang keluar berhasil dicatat!');
        }

        // 🔹 Jika transaksi adalah retur (barang dikembalikan ke supplier)
        if ($validated['tipe_transaksi'] === 'retur') {
            $barang->jumlah += $validated['jumlah']; // tambahkan stok kembali
            $barang->save();

            BarangKeluar::create([
                'product_id'    => $barang->id,
                'nama_barang'   => $barang->name,
                'nama_penerima' => $validated['nama_penerima'],
                'jumlah'        => $validated['jumlah'],
                'tipe_transaksi'=> 'retur',
            ]);

            return redirect()->route('barang-keluar')
                ->with('success', 'Retur barang berhasil diproses!');
        }
    }

    // 🔹 Dashboard Statistik Barang
    public function dashboard()
    {
        $barangMasuk  = BarangMasuk::sum('jumlah');
        $barangKeluar = BarangKeluar::where('tipe_transaksi', 'keluar')->sum('jumlah');
        $barangRetur  = BarangKeluar::where('tipe_transaksi', 'retur')->sum('jumlah');

        return view('barang.dashboard', compact('barangMasuk', 'barangKeluar', 'barangRetur'));
    }
}
