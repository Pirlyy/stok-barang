@extends('layouts.app')
@section('title','Data Barang')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Data Barang</h1>

    @if(session('success'))
        <div class="mb-4 rounded bg-green-100 text-green-700 px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">#</th>
                <th class="border px-4 py-2 text-left">Nama Barang</th>
                <th class="border px-4 py-2 text-left">Satuan</th>
                <th class="border px-4 py-2 text-left">Jumlah</th>
                <th class="border px-4 py-2 text-left">Supplier</th>
                <th class="border px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $i => $b)
            <tr>
                <td class="border px-4 py-2">{{ $i+1 }}</td>
                <td class="border px-4 py-2">
                    <form action="{{ route('data-barang.update',$b->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="text" name="nama_barang" value="{{ $b->nama_barang }}" class="border p-1 w-full">
                </td>
                <td class="border px-4 py-2">
                        <input type="text" name="satuan" value="{{ $b->satuan }}" class="border p-1 w-full">
                </td>
                <td class="border px-4 py-2">
                        <input type="number" name="jumlah" value="{{ $b->jumlah }}" class="border p-1 w-full">
                </td>
                <td class="border px-4 py-2">
                        <input type="text" name="supplier" value="{{ $b->supplier ?? '-' }}" class="border p-1 w-full">
                </td>
                <td class="border px-4 py-2">
                        <button class="text-green-600">Save</button>
                    </form> |
                    <form action="{{ route('data-barang.destroy',$b->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
