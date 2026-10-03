<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dasbor Admin - Sistem Percetakan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FontAwesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>


<body class="h-screen grid grid-cols-[250px_1fr] grid-rows-[70px_1fr] bg-gray-50 text-gray-800 font-sans">


    <!-- ===================================================== -->
    <!-- KOTAK 1: NAMA SISTEM -->
    <!-- ===================================================== -->

    <div class="bg-white border-b border-r border-gray-200 flex items-center px-6 z-20">

        <span class="font-bold text-xl text-blue-700 tracking-wide">

            <i class="fa-solid fa-print mr-2"></i>

            SISTA

        </span>

    </div>



    <!-- ===================================================== -->
    <!-- KOTAK 2: NAVBAR -->
    <!-- ===================================================== -->

    <div class="bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm z-10">


        <!-- SAPAAN -->

        <div class="text-sm text-gray-500 font-medium">

            Selamat datang, Admin!

        </div>



        <!-- ================================================= -->
        <!-- PROFILE DROPDOWN -->
        <!-- ================================================= -->

        <details class="relative">


            <!-- ICON PROFILE -->

            <summary
                class="list-none cursor-pointer flex items-center
                       hover:opacity-80 transition select-none">

                <i class="fa-regular fa-circle-user
                          text-3xl text-gray-600">
                </i>

            </summary>



            <!-- DROPDOWN -->

            <div
                class="absolute right-0 top-12
                       w-44
                       bg-white
                       border border-gray-200
                       rounded-lg
                       shadow-lg
                       z-[9999]
                       overflow-hidden">


                <!-- PROFIL -->

                <a href="{{ route('profile') }}"
                   class="flex items-center gap-3
                          px-4 py-3
                          text-sm text-gray-700
                          hover:bg-gray-100
                          transition">

                    <i class="fa-regular fa-user w-5 text-gray-500"></i>

                    <span>
                        Profil
                    </span>

                </a>



                <!-- PEMBATAS -->

                <div class="border-t border-gray-100"></div>



                <!-- KELUAR -->

                <button
                    type="button"
                    onclick="openLogoutModal()"
                    class="w-full
                           flex items-center gap-3
                           px-4 py-3
                           text-sm text-red-600
                           hover:bg-red-50
                           transition
                           text-left">

                    <i class="fa-solid fa-right-from-bracket w-5"></i>

                    <span>
                        Keluar
                    </span>

                </button>


            </div>

        </details>


    </div>



    <!-- ===================================================== -->
    <!-- KOTAK 3: SIDEBAR -->
    <!-- ===================================================== -->

    <div
        class="bg-white
               border-r border-gray-200
               flex flex-col
               justify-between
               p-4
               z-10
               overflow-y-auto">


        <!-- MENU ATAS -->

        <div>


            <!-- MENU UTAMA -->

            <div
                class="text-[10px]
                       font-bold
                       text-gray-400
                       uppercase
                       tracking-wider
                       mb-3
                       px-3">

                Menu Utama

            </div>


            <nav class="flex flex-col gap-1 mb-8">


                <!-- DASHBOARD -->

                <a href="{{ route('admin') }}"
                   class="flex items-center gap-3
                          px-3 py-2.5
                          rounded-lg
                          font-medium
                          transition
                          {{ request()->routeIs('admin')
                              ? 'bg-blue-50 text-blue-700'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                    <i class="fa-solid fa-chart-pie w-5 text-center"></i>

                    Dashboard

                </a>



                <!-- TRANSAKSI -->

                <a href="{{ route('transaksi.index') }}"
                   class="flex items-center gap-3
                          px-3 py-2.5
                          rounded-lg
                          font-medium
                          transition
                          {{ request()->routeIs('transaksi.*')
                              ? 'bg-blue-50 text-blue-700'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                    <i class="fa-solid fa-cash-register w-5 text-center"></i>

                    Transaksi

                </a>



                <!-- PRODUK -->

                <a href="{{ route('produk.index') }}"
                   class="flex items-center gap-3
                          px-3 py-2.5
                          rounded-lg
                          font-medium
                          transition
                          {{ request()->routeIs('produk.*')
                              ? 'bg-blue-50 text-blue-700'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                    <i class="fa-solid fa-box w-5 text-center"></i>

                    Produk

                </a>



                <!-- JURNAL -->

                <a href="{{ route('jurnal.index') }}"
                   class="flex items-center gap-3
                          px-3 py-2.5
                          rounded-lg
                          font-medium
                          transition
                          {{ request()->routeIs('jurnal.*')
                              ? 'bg-blue-50 text-blue-700'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                    <i class="fa-solid fa-book w-5 text-center"></i>

                    Jurnal Umum

                </a>



                <!-- BUKU BESAR -->

                <a href="{{ route('buku_besar.index') }}"
                   class="flex items-center gap-3
                          px-3 py-2.5
                          rounded-lg
                          font-medium
                          transition
                          {{ request()->routeIs('buku_besar.*')
                              ? 'bg-blue-50 text-blue-700'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                    <i class="fa-solid fa-book-open w-5 text-center"></i>

                    Buku Besar

                </a>

            </nav>



            <!-- ================================================= -->
            <!-- MASTER DATA -->
            <!-- ================================================= -->

            @if (Auth::user()->role === 'Admin Pusat')

                <div
                    class="text-[10px]
                           font-bold
                           text-gray-400
                           uppercase
                           tracking-wider
                           mb-3
                           px-3">

                    Master Data

                </div>


                <nav class="flex flex-col gap-1">


                    <!-- CABANG -->

                    <a href="{{ route('cabang.index') }}"
                       class="flex items-center gap-3
                              px-3 py-2.5
                              rounded-lg
                              font-medium
                              transition
                              {{ request()->routeIs('cabang.*')
                                  ? 'bg-blue-50 text-blue-700'
                                  : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                        <i class="fa-solid fa-store w-5 text-center"></i>

                        Cabang

                    </a>



                    <!-- USER -->

                    <a href="{{ route('user.index') }}"
                       class="flex items-center gap-3
                              px-3 py-2.5
                              rounded-lg
                              font-medium
                              transition
                              {{ request()->routeIs('user.*')
                                  ? 'bg-blue-50 text-blue-700'
                                  : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                        <i class="fa-solid fa-users w-5 text-center"></i>

                        User

                    </a>



                    <!-- AKUN -->

                    <a href="{{ route('akun.index') }}"
                       class="flex items-center gap-3
                              px-3 py-2.5
                              rounded-lg
                              font-medium
                              transition
                              {{ request()->routeIs('akun.*')
                                  ? 'bg-blue-50 text-blue-700'
                                  : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                        <i class="fa-solid fa-list-ul w-5 text-center"></i>

                        Akun

                    </a>

                </nav>

            @endif


        </div>

    </div>



    <!-- ===================================================== -->
    <!-- KOTAK 4: MAIN CONTENT -->
    <!-- ===================================================== -->

    <div class="overflow-y-auto p-8 w-full">

        {{ $slot }}

    </div>



    <!-- ===================================================== -->
    <!-- MODAL KONFIRMASI LOGOUT -->
    <!-- ===================================================== -->

    <div
        id="logoutModal"
        class="hidden fixed inset-0
               bg-black/50
               backdrop-blur-sm
               flex items-center justify-center
               z-[99999]
               px-4">


        <!-- MODAL CARD -->

        <div
            class="bg-white
                   w-full
                   max-w-sm
                   rounded-xl
                   shadow-2xl
                   overflow-hidden">


            <!-- ============================================= -->
            <!-- ICON -->
            <!-- ============================================= -->

            <div class="pt-5 flex justify-center">

                <div
                    class="w-12
                           h-12
                           rounded-xl
                           bg-red-50
                           flex
                           items-center
                           justify-center">

                    <i
                        class="fa-solid fa-right-from-bracket
                               text-red-500
                               text-xl">
                    </i>

                </div>

            </div>



            <!-- ============================================= -->
            <!-- ISI -->
            <!-- ============================================= -->

            <div class="px-6 pt-3 pb-4 text-center">


                <h2
                    class="text-base
                           font-bold
                           text-gray-900">

                    Konfirmasi Keluar

                </h2>


                <p
                    class="text-[11px]
                           text-gray-500
                           leading-relaxed
                           mt-2">

                    Sesi akun Anda akan diakhiri.
                    Anda harus memasukkan username dan kata sandi
                    kembali untuk mengakses sistem SISTA.

                </p>


                <!-- ========================================= -->
                <!-- USER INFO -->
                <!-- ========================================= -->

                <div
                    class="mt-4
                           bg-gray-50
                           border
                           border-gray-200
                           rounded-lg
                           px-3
                           py-2.5
                           flex
                           items-center
                           gap-3
                           text-left">


                    <!-- AVATAR -->

                    <div
                        class="w-8
                               h-8
                               rounded-full
                               bg-blue-600
                               flex
                               items-center
                               justify-center
                               flex-shrink-0">

                        <span
                            class="text-[10px]
                                   font-bold
                                   text-white">

                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}

                        </span>

                    </div>


                    <!-- USER -->

                    <div class="min-w-0 flex-1">


                        <div
                            class="flex
                                   items-center
                                   gap-2">


                            <p
                                class="text-[10px]
                                       font-semibold
                                       text-gray-800">

                                {{ Auth::user()->name }}

                            </p>


                            <!-- ROLE -->

                            <span
                                class="px-1.5
                                       py-0.5
                                       rounded-full
                                       bg-blue-100
                                       text-blue-600
                                       text-[7px]
                                       font-bold
                                       uppercase">

                                {{ Auth::user()->role }}

                            </span>

                        </div>


                        <p
                            class="text-[8px]
                                   text-gray-500
                                   truncate">

                            {{ Auth::user()->email }}

                        </p>


                    </div>


                </div>


            </div>



            <!-- ============================================= -->
            <!-- BUTTON -->
            <!-- ============================================= -->

            <div
                class="border-t
                       border-gray-100
                       px-5
                       py-3
                       flex
                       justify-end
                       gap-2">


                <!-- BATAL -->

                <button
                    type="button"
                    onclick="closeLogoutModal()"
                    class="px-4
                           py-2
                           rounded-lg
                           bg-gray-100
                           text-gray-600
                           text-[10px]
                           font-medium
                           hover:bg-gray-200
                           transition">

                    Batal

                </button>



                <!-- YA, KELUAR -->

                <form
                    action="{{ route('logout') }}"
                    method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="px-4
                               py-2
                               rounded-lg
                               bg-red-600
                               text-white
                               text-[10px]
                               font-medium
                               hover:bg-red-700
                               transition
                               inline-flex
                               items-center
                               gap-2">


                        <i
                            class="fa-solid fa-right-from-bracket text-[9px]">
                        </i>


                        Ya, Keluar


                    </button>

                </form>


            </div>


        </div>

    </div>



    <!-- ===================================================== -->
    <!-- JAVASCRIPT MODAL -->
    <!-- ===================================================== -->

    <script>

        function openLogoutModal() {

            const modal = document.getElementById('logoutModal');

            modal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

        }


        function closeLogoutModal() {

            const modal = document.getElementById('logoutModal');

            modal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }


        // Klik area luar modal = tutup

        document.getElementById('logoutModal').addEventListener('click', function(event) {

            if (event.target === this) {

                closeLogoutModal();

            }

        });


        // Tombol ESC = tutup

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {

                closeLogoutModal();

            }

        });

    </script>


</body>

</html>