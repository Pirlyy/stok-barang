<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Inventaris Gudang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <form method="POST" action="{{ url('/login') }}" class="bg-white p-6 rounded-lg shadow-lg w-96">
        @csrf
        <h2 class="text-2xl font-bold mb-4">Login</h2>

        @if(session('error'))
            <p class="bg-red-100 text-red-600 px-3 py-2 rounded mb-3">{{ session('error') }}</p>
        @endif

        <label class="block">Email</label>
        <input name="email" type="email" required class="w-full border rounded px-3 py-2 mb-3">

        <label class="block">Password</label>
        <input name="password" type="password" required class="w-full border rounded px-3 py-2 mb-3">

        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Login</button>

        <p class="text-sm mt-3">Belum punya akun? <a href="{{ url('/register') }}" class="text-blue-500">Register</a></p>
    </form>

</body>
</html>
