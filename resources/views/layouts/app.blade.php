<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Inventaris Gudang' }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white min-h-screen p-4">
        <h1 class="text-xl font-bold mb-6">Inventaris Gudang</h1>
        <nav class="space-y-3">
            <a href="{{ route('dashboard') }}" class="block p-2 rounded hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('barang-masuk') }}" class="block p-2 rounded hover:bg-gray-700">Barang Masuk</a>
            <a href="{{ route('barang-keluar') }}" class="block p-2 rounded hover:bg-gray-700">Barang Keluar</a>
            <a href="{{ route('data-barang') }}" class="block p-2 rounded hover:bg-gray-700">Data Barang</a>
            <a href="{{ route('stok-barang') }}" class="block p-2 rounded hover:bg-gray-700">Stock Barang</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full text-left p-2 rounded hover:bg-red-700 mt-6">Logout</button>
            </form>
        </nav>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</body>
</html>
