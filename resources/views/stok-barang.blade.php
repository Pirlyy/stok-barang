@extends('layouts.app')
@section('title','Stok Barang')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Stok Barang</h1>

    {{-- ✅ Jika tidak ada produk --}}
    @if($stok->isEmpty())
        <div class="text-center text-gray-500">Belum ada produk yang tersedia.</div>
    @else
        {{-- ✅ Grid Card --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($stok as $p)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                {{-- Gambar Produk --}}
                <div class="relative w-full h-52 bg-gray-100">
                    @if($p->image)
                        <img src="{{ asset('uploads/barang/'.$p->image) }}" 
                             alt="{{ $p->name }}" 
                             class="object-cover w-full h-full">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-400">Tidak ada gambar</div>
                    @endif
                </div>

                {{-- Detail Produk --}}
                <div class="p-4 space-y-2">
                    <h2 class="text-lg font-semibold text-gray-800 truncate">{{ $p->name }}</h2>
                    <p class="text-gray-600 text-sm line-clamp-2">{{ $p->description ?: 'Tidak ada deskripsi.' }}</p>

                    <div class="flex justify-between items-center mt-3">
                        <span class="text-green-600 font-bold">Rp {{ number_format($p->price, 0, ',', '.') }}</span>
                        <span class="text-sm text-gray-500">Stok: {{ $p->jumlah }}</span>
                    </div>

                    <p class="text-xs text-gray-400 mt-1">Supplier: {{ $p->supplier ?: '-' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
