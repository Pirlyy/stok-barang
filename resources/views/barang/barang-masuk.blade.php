@extends('layouts.app')
@section('title', 'Barang Masuk')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-4xl mx-auto bg-white p-10 rounded-2xl shadow-xl border border-gray-200">
        <h1 class="text-3xl font-extrabold mb-8 text-center text-gray-800 tracking-wide">
            Barang Masuk (Dari Supplier)
        </h1>

        {{-- ✅ Notifikasi sukses --}}
        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-100 text-green-700 px-5 py-3 text-center font-medium shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ Form Input Barang --}}
        <form action="{{ route('barang-masuk.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf

            {{-- Pilih Barang Lama atau Tambah Barang Baru --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Barang</label>
                <select name="existing_product_id" id="existing_product_id"
                        class="border border-gray-300 p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-50">
                    <option value="">🆕 Tambah Barang Baru</option>
                    @foreach($produk as $item)
                        <option value="{{ $item->id }}" data-supplier="{{ $item->supplier }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Bagian input barang baru --}}
            <div id="newProductFields" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Barang</label>
                    <input type="text" name="name" 
                           class="border border-gray-300 p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                           placeholder="Masukkan nama barang baru">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Harga Satuan</label>
                    <input type="number" name="price" min="0"
                           class="border border-gray-300 p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                           placeholder="Contoh: 10000">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Barang</label>
                    <textarea name="description" rows="3"
                              class="border border-gray-300 p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none" 
                              placeholder="Masukkan deskripsi barang..."></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Gambar Barang (Opsional)</label>
                    <input type="file" name="image" 
                           accept="image/*"
                           class="border border-gray-300 p-3 w-full rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            {{-- Jumlah dan Supplier --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Barang Masuk</label>
                    <input type="number" name="jumlah" min="1" required
                           class="border border-gray-300 p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                           placeholder="Masukkan jumlah barang">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Supplier</label>
                    <input type="text" name="supplier" id="supplier"
                           class="border border-gray-300 p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-50" 
                           placeholder="Otomatis terisi jika memilih barang lama">
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="text-center mt-6">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                    Simpan Barang
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script interaktif --}}
<script>
    const existingSelect = document.getElementById('existing_product_id');
    const newProductFields = document.getElementById('newProductFields');
    const supplierField = document.getElementById('supplier');

    existingSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const supplierName = selectedOption.getAttribute('data-supplier');

        // Sembunyikan atau tampilkan field barang baru
        newProductFields.style.display = this.value ? 'none' : 'grid';

        // Jika barang lama dipilih, isi otomatis supplier
        supplierField.value = supplierName ?? '';
    });
</script>
@endsection
