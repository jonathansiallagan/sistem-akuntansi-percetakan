<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Halaman Admin</h1>
        <p class="text-gray-600">Selamat datang di panel kontrol administrator.</p>
    </div>

    <!-- Form Logout -->
    <div class="text-center bg-white p-10 rounded-lg shadow-md">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Halaman Admin</h1>
        <p class="text-gray-600 mb-8">Selamat datang di panel kontrol administrator.</p>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Keluar (Logout)
            </button>
        </form>
    </div>
</body>
</html>