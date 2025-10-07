@extends('layouts.app')
@section('title', 'Barang Masuk')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
        <h1 class="text-3xl font-extrabold mb-6 text-center text-gray-800 tracking-wide">
            Tambah Barang Masuk
        </h1>

        {{-- ✅ Notifikasi sukses --}}
        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-100 text-green-700 px-4 py-3 text-center font-medium shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ Form Input Barang --}}
        <form action="{{ route('barang-masuk.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @csrf

            {{-- Nama Barang --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Barang</label>
                <input type="text" name="name" 
                       class="border border-gray-300 p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                       placeholder="Masukkan nama barang" required>
            </div>

            {{-- Harga --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga</label>
                <input type="number" name="price" min="0"
                       class="border border-gray-300 p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                       placeholder="Contoh: 10000" required>
            </div>

            {{-- Jumlah --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah</label>
                <input type="number" name="jumlah" min="1"
                       class="border border-gray-300 p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                       placeholder="Masukkan jumlah barang" required>
            </div>

            {{-- Supplier --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Supplier</label>
                <input type="text" name="supplier"
                       class="border border-gray-300 p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                       placeholder="Masukkan nama supplier (opsional)">
            </div>

            {{-- Deskripsi --}}
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Barang</label>
                <textarea name="description" rows="3"
                          class="border border-gray-300 p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none" 
                          placeholder="Masukkan deskripsi barang..."></textarea>
            </div>

            {{-- Upload Gambar --}}
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Barang (Opsional)</label>
                <input type="file" name="image" 
                       accept="image/*"
                       class="border border-gray-300 p-3 w-full rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            {{-- Tombol Simpan --}}
            <div class="sm:col-span-2 text-center mt-4">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                    Simpan Barang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
