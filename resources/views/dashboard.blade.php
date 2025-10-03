@extends('layouts.app') {{-- Sesuaikan dengan layout utama kamu --}}

@section('content')
<div class="p-6 bg-white shadow rounded">

    <h2 class="text-xl font-bold mb-4">Dashboard Statistik</h2>

    <canvas id="barangChart" height="120"></canvas>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('barangChart').getContext('2d');
    new Chart(ctx, {
        type: 'line', // bisa diganti 'line', 'pie', dll
        data: {
            labels: ['Barang Masuk', 'Barang Keluar'],
            datasets: [{
                label: 'Jumlah Barang',
                data: [{{ $barangMasuk }}, {{ $barangKeluar }}],
                backgroundColor: ['#4ade80', '#f87171'], // Hijau & Merah
            }]
        }
    });
</script>
@endsection
