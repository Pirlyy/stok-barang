@extends('layouts.app')
@section('title','Barang Masuk')
@section('content')

<h1 class="text-2xl font-bold mb-6">Barang Masuk</h1>

@if(session('success'))
    <div class="mb-4 rounded bg-green-100 text-green-700 px-4 py-2">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('barang.store') }}" method="POST" autocomplete="off" class="grid grid-cols-2 gap-6 bg-white p-6 rounded shadow">
    @csrf

    <div>
        <label class="block font-medium mb-1">Nama Barang</label>
        <input name="nama_barang" type="text" required class="w-full border rounded-lg px-3 py-2" value="{{ old('nama_barang') }}">
    </div>

    <div>
        <label class="block font-medium mb-1">Satuan</label>
        <input name="satuan" type="text" required class="w-full border rounded-lg px-3 py-2" value="{{ old('satuan') }}">
    </div>

    <div>
        <label class="block font-medium mb-1">Jumlah</label>
        <input name="jumlah" type="number" min="1" required class="w-full border rounded-lg px-3 py-2" value="{{ old('jumlah') }}">
    </div>

    <div>
        <label class="block font-medium mb-1">Supplier</label>
        <input name="supplier" type="text" class="w-full border rounded-lg px-3 py-2" value="{{ old('supplier') }}">
    </div>

    <div class="col-span-2">
        <label class="block font-medium mb-1">Tanggal Masuk</label>
        <input name="tanggal" type="date" required class="w-full border rounded-lg px-3 py-2" value="{{ old('tanggal') }}">
    </div>

    <div class="col-span-2 flex gap-3">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">Simpan</button>
        <button type="reset" class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-lg">Reset</button>
    </div>

</form>

@endsection
