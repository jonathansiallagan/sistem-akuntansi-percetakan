<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Admin - Sistem Percetakan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Tambahan FontAwesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="h-screen grid grid-cols-[250px_1fr] grid-rows-[70px_1fr] bg-gray-50 text-gray-800 font-sans">

    <!-- KOTAK 1: Nama Sistem -->
    <div class="bg-white border-b border-r border-gray-200 flex items-center px-6 z-20">
        <span class="font-bold text-xl text-blue-700 tracking-wide">
            <i class="fa-solid fa-print mr-2"></i> SISTA
        </span>
    </div>

    <!-- KOTAK 2: NavBar -->
    <div class="bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm z-10">
        <div class="text-sm text-gray-500 font-medium">Selamat datang kembali, Admin!</div>
        
        <!-- Tombol Logout yang Dipindah ke Navbar -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-bold transition flex items-center gap-2">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar
            </button>
        </form>
    </div>

    <!-- KOTAK 3: Control Panel / Sidebar -->
    <div class="bg-white border-r border-gray-200 flex flex-col p-4 z-10">
        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-3 px-3">Menu Utama</div>
        
        <nav class="flex flex-col gap-1">
            <!-- Menu Aktif (Contoh Dasbor) -->
            <a href="{{ route('admin') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-blue-50 text-blue-700 font-medium transition">
                <i class="fa-solid fa-chart-pie w-5 text-center"></i> Dasbor
            </a>
            
            <!-- Menu Pasif -->
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition">
                <i class="fa-solid fa-box w-5 text-center"></i> Data Produk
            </a>
            
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition">
                <i class="fa-solid fa-file-invoice-dollar w-5 text-center"></i> Pesanan
            </a>
            
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition">
                <i class="fa-solid fa-users w-5 text-center"></i> Karyawan
            </a>
        </nav>
    </div>

    <!-- KOTAK 4: Main Content -->
    <div class="overflow-y-auto p-8">
        @yield('content')
    </div>

</body>
</html>