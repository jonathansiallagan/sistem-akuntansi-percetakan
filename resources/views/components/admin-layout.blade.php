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
        <!-- Teks Sapaan (Bisa dibuat dinamis mengambil nama user yang login nantinya) -->
        <div class="text-sm text-gray-500 font-medium">Selamat datang, Admin!</div>
        
        <!-- Ikon Profil -->
        <div class="flex items-center gap-3 cursor-pointer hover:opacity-80 transition">
            <!-- Menggunakan ikon user di dalam lingkaran dari FontAwesome -->
            <i class="fa-regular fa-circle-user text-3xl text-gray-600"></i>
        </div>
    </div>

    <!-- KOTAK 3: Control Panel / Sidebar -->
    <div class="bg-white border-r border-gray-200 flex flex-col justify-between p-4 z-10 overflow-y-auto">
        
        <!-- BAGIAN ATAS: Berisi semua menu navigasi -->
        <div>
            <!-- KELOMPOK 1: MENU UTAMA -->
            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-3 px-3">Menu Utama</div>
            <nav class="flex flex-col gap-1 mb-8">
                <a href="{{ route('admin') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-blue-50 text-blue-700 font-medium transition">
                    <i class="fa-solid fa-chart-pie w-5 text-center"></i> Dashboard
                </a>
                
                <a href="{{ route('transaksi.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition">
                    <i class="fa-solid fa-cash-register w-5 text-center"></i> Transaksi
                </a>
                
                <a href="{{ route('produk.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition">
                    <i class="fa-solid fa-box w-5 text-center"></i> Produk
                </a>
                
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition">
                    <i class="fa-solid fa-book w-5 text-center"></i> Jurnal Umum
                </a>

                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition">
                    <i class="fa-solid fa-book-open w-5 text-center"></i> Buku Besar
                </a>
            </nav>

            <!-- KELOMPOK 2: MASTER DATA -->
            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-3 px-3">Master Data</div>
            <nav class="flex flex-col gap-1">
                <a href="{{ route('cabang.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition">
                    <i class="fa-solid fa-store w-5 text-center"></i> Cabang
                </a>
                
                <a href="{{ route('user.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition">
                    <i class="fa-solid fa-users w-5 text-center"></i> User
                </a>
                
                <a href="{{ route('akun.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition">
                    <i class="fa-solid fa-list-ul w-5 text-center"></i> Akun
                </a>
            </nav>
        </div>

        <!-- BAGIAN BAWAH: Tombol Keluar (Logout) -->
        <div class="mt-8 pt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-500 hover:bg-red-50 hover:text-red-700 font-medium transition">
                    <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> Keluar
                </button>
            </form>
        </div>

    </div>

    <!-- KOTAK 4: Main Content -->
    <div class="overflow-y-auto p-8 w-full">
        {{ $slot }}
    </div>

</body>
</html>