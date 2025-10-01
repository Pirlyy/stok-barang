<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Sistem Inventaris Gudang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <form method="POST" action="{{ url('/register') }}" class="bg-white p-6 rounded-lg shadow-lg w-96">
        @csrf
        <h2 class="text-2xl font-bold mb-4">Register</h2>

        <label class="block">Nama</label>
        <input name="name" type="text" required class="w-full border rounded px-3 py-2 mb-3">

        <label class="block">Email</label>
        <input name="email" type="email" required class="w-full border rounded px-3 py-2 mb-3">

        <label class="block">Password</label>
        <input name="password" type="password" required class="w-full border rounded px-3 py-2 mb-3">

        <button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded">Register</button>

        <p class="text-sm mt-3">Sudah punya akun? <a href="{{ url('/login') }}" class="text-blue-500">Login</a></p>
    </form>

</body>
</html>
