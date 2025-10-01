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
                <td class="border px-4 py-2">{{ $b->nama_barang }}</td>
                <td class="border px-4 py-2">{{ $b->satuan }}</td>
                <td class="border px-4 py-2">{{ $b->jumlah }}</td>
                <td class="border px-4 py-2">{{ $b->supplier ?? '-' }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('data-barang.edit',$b->id) }}" class="text-blue-600">Edit</a> |
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
