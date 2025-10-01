<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\DataBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function indexBarangMasuk()
    {
        return view('barang-masuk');
    }

    public function storeBarangMasuk(Request $request)
    {
        $data = $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required',
            'supplier' => 'required',
            'tanggal' => 'required|date'
        ]);

        DB::transaction(function () use ($data) {
            BarangMasuk::create($data);

            $row = DataBarang::firstOrCreate(
                ['nama_barang' => $data['nama_barang']],
                ['jumlah' => 0, 'stok' => 0, 'satuan' => $data['satuan'], 'supplier' => $data['supplier']]
            );

            $row->increment('jumlah', $data['jumlah']);
            $row->increment('stok', $data['jumlah']);
        });

        return back()->with('success', 'Barang masuk berhasil');
    }

    public function indexBarangKeluar()
    {
        $barangs = DataBarang::all();
        return view('barang-keluar', compact('barangs'));
    }

    public function storeBarangKeluar(Request $request)
    {
        $data = $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required',
            'tanggal' => 'required|date',
            'penerima' => 'required'
        ]);

        BarangKeluar::create($data);

        $row = DataBarang::where('nama_barang', $data['nama_barang'])->first();
        if ($row) {
            $row->decrement('stok', $data['jumlah']);
            if ($row->stok < 0) $row->stok = 0;
            $row->save();
        }

        return back()->with('success', 'Barang keluar berhasil');
    }

    public function indexDataBarang()
    {
        $barangs = DataBarang::all();
        return view('data-barang', compact('barangs'));
    }

    public function indexStokBarang()
    {
        $barangs = DataBarang::all();
        return view('stok-barang', compact('barangs'));
    }
}
