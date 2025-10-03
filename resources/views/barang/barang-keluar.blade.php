@extends('layouts.app')
@section('title','Barang Keluar')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Form Barang Keluar</h1>

    {{-- Notifikasi sukses atau error --}}
    @if(session('success'))
        <div class="mb-4 rounded bg-green-100 text-green-700 px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 rounded bg-red-100 text-red-700 px-4 py-2">
            {{ session('error') }}
        </div>
    @endif

    {{-- Validasi error --}}
    @if($errors->any())
        <div class="mb-4 rounded bg-red-100 text-red-700 px-4 py-2">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang-keluar.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-semibold">Nama Penerima</label>
            <input type="text" name="nama_penerima" class="border p-2 w-full" placeholder="Masukkan nama penerima" required>
        </div>
        <div>
            <label class="block font-semibold">Pilih Barang</label>
            <select name="id" class="border p-2 w-full">
                @foreach($barang as $b)
                    <option value="{{ $b->id }}">
                        {{ $b->name }} (Stok: {{ $b->jumlah }})
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold">Jumlah Keluar</label>
            <input type="number" name="jumlah" class="border p-2 w-full" min="1" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
