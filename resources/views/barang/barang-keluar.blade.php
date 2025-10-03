@extends('layouts.app')
@section('title','Barang Keluar')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Barang Keluar</h1>

    @if(session('success'))
        <div class="mb-4 rounded bg-green-100 text-green-700 px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('barang-keluar.store') }}" method="POST" autocomplete="off" class="grid grid-cols-2 gap-6 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label class="block font-medium mb-1">Nama Barang</label>
            <select name="nama_barang" class="w-full border rounded-lg px-3 py-2" required>
                @foreach($barang as $b)
                    <option value="{{ $b->nama_barang }}">{{ $b->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Satuan</label>
            <input name="satuan" type="text" required class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Jumlah Keluar</label>
            <input name="jumlah" type="number" min="1" required class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Tanggal Keluar</label>
            <input name="tanggal" type="date" required class="w-full border rounded-lg px-3 py-2">
        </div>

        <div class="col-span-2">
            <label class="block font-medium mb-1">Penerima</label>
            <input name="penerima" type="text" required class="w-full border rounded-lg px-3 py-2">
        </div>

        <div class="col-span-2 flex gap-3">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">Simpan</button>
            <button type="reset" class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-lg">Reset</button>
        </div>
    </form>
</div>
@endsection
