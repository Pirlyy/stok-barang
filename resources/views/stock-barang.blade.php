@extends('layouts.app')
@section('title','Stok Barang')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Stok Barang</h1>

    <table class="w-full border-collapse bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">#</th>
                <th class="border px-4 py-2 text-left">Nama Barang</th>
                <th class="border px-4 py-2 text-left">Satuan</th>
                <th class="border px-4 py-2 text-left">Stok Sekarang</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stok as $i => $s)
            <tr>
                <td class="border px-4 py-2">{{ $i+1 }}</td>
                <td class="border px-4 py-2">{{ $s->nama_barang }}</td>
                <td class="border px-4 py-2">{{ $s->satuan }}</td>
                <td class="border px-4 py-2 font-bold {{ $s->stok <= 0 ? 'text-red-600' : 'text-green-600' }}">
                    {{ $s->stok }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
