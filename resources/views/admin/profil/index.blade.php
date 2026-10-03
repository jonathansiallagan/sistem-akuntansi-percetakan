<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Profil Saya - SISTA</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <!-- FontAwesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>


<body class="min-h-screen bg-gray-50 font-sans text-gray-800">


    <!-- ================================================= -->
    <!-- CONTAINER -->
    <!-- ================================================= -->

    <div class="min-h-screen flex items-start justify-center">


        <div class="w-full max-w-md mt-14 px-4">


            <!-- ================================================= -->
            <!-- TOMBOL KEMBALI -->
            <!-- ================================================= -->

            <div class="mb-3">

                <a
                    href="{{ route('admin') }}"
                    class="inline-flex
                           items-center
                           gap-2
                           px-3
                           py-1.5
                           bg-white
                           border
                           border-gray-200
                           rounded-lg
                           text-[11px]
                           text-gray-600
                           hover:bg-gray-50
                           transition">

                    <i class="fa-solid fa-arrow-left text-[9px]"></i>

                    <span>
                        Kembali
                    </span>

                </a>

            </div>



            <!-- ================================================= -->
            <!-- PROFILE CARD -->
            <!-- ================================================= -->

            <div
                class="bg-white
                       border
                       border-gray-200
                       rounded-xl
                       overflow-hidden">


                <!-- ================================================= -->
                <!-- USER HEADER -->
                <!-- ================================================= -->

                <div class="px-4 py-4">

                    <div class="flex items-center gap-3">


                        <!-- AVATAR -->

                        <div
                            class="w-12
                                   h-12
                                   rounded-lg
                                   bg-blue-50
                                   border
                                   border-blue-200
                                   flex
                                   items-center
                                   justify-center
                                   flex-shrink-0">

                            <span
                                class="text-lg
                                       font-bold
                                       text-blue-600">

                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}

                            </span>

                        </div>



                        <!-- USER INFO -->

                        <div class="min-w-0">

                            <div
                                class="flex
                                       items-center
                                       gap-1.5
                                       flex-wrap">


                                <h1
                                    class="text-sm
                                           font-bold
                                           text-gray-900">

                                    {{ Auth::user()->name }}

                                </h1>


                                <!-- ROLE -->

                                <span
                                    class="px-1.5
                                           py-0.5
                                           rounded-full
                                           bg-blue-50
                                           text-blue-600
                                           text-[8px]
                                           font-medium">

                                    {{ Auth::user()->role }}

                                </span>

                            </div>


                            <!-- EMAIL -->

                            <p
                                class="text-[9px]
                                       text-gray-500
                                       mt-0.5
                                       truncate">

                                {{ Auth::user()->email }}

                            </p>


                            <!-- STATUS -->

                            <div class="mt-1">

                                <span
                                    class="inline-flex
                                           items-center
                                           gap-1
                                           px-1.5
                                           py-0.5
                                           rounded-full
                                           bg-green-50
                                           text-green-600
                                           text-[8px]">

                                    <span
                                        class="w-1
                                               h-1
                                               rounded-full
                                               bg-green-500">
                                    </span>

                                    Aktif

                                </span>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- ================================================= -->
                <!-- PEMBATAS -->
                <!-- ================================================= -->

                <div class="border-t border-gray-100"></div>



                <!-- ================================================= -->
                <!-- DETAIL INFORMASI -->
                <!-- ================================================= -->

                <div class="px-4 py-4">


                    <!-- JUDUL -->

                    <div
                        class="flex
                               items-center
                               justify-between
                               mb-3">

                        <h2
                            class="text-[9px]
                                   font-semibold
                                   text-gray-400
                                   uppercase
                                   tracking-wide">

                            Detail Informasi Pengguna

                        </h2>


                        

                    </div>



                    <!-- ================================================= -->
                    <!-- NAMA -->
                    <!-- ================================================= -->

                    <div
                        class="bg-gray-50
                               rounded-lg
                               px-3
                               py-2.5
                               mb-2.5">

                        <p
                            class="text-[8px]
                                   text-gray-400
                                   mb-1">

                            Nama Lengkap

                        </p>

                        <p
                            class="text-[10px]
                                   font-medium
                                   text-gray-800">

                            {{ Auth::user()->name }}

                        </p>

                    </div>



                    <!-- ================================================= -->
                    <!-- USERNAME -->
                    <!-- ================================================= -->

                    <div
                        class="bg-gray-50
                               rounded-lg
                               px-3
                               py-2.5
                               mb-2.5">

                        <p
                            class="text-[8px]
                                   text-gray-400
                                   mb-1">

                            Username Akun

                        </p>

                        <p
                            class="text-[10px]
                                   font-medium
                                   text-gray-800">

                            {{ Auth::user()->username ?? '-' }}

                        </p>

                    </div>



                    <!-- ================================================= -->
                    <!-- EMAIL -->
                    <!-- ================================================= -->

                    <div
                        class="bg-gray-50
                               rounded-lg
                               px-3
                               py-2.5
                               mb-2.5">

                        <p
                            class="text-[8px]
                                   text-gray-400
                                   mb-1">

                            Alamat Email

                        </p>

                        <p
                            class="text-[10px]
                                   font-medium
                                   text-gray-800
                                   break-all">

                            {{ Auth::user()->email }}

                        </p>

                    </div>



                    <!-- ================================================= -->
                    <!-- ROLE -->
                    <!-- ================================================= -->

                    <div
                        class="bg-gray-50
                               rounded-lg
                               px-3
                               py-2.5">

                        <p
                            class="text-[8px]
                                   text-gray-400
                                   mb-1">

                            Role / Hak Akses

                        </p>

                        <p
                            class="text-[10px]
                                   font-medium
                                   text-blue-600">

                            {{ Auth::user()->role }}

                        </p>

                    </div>

                </div>



                <!-- ================================================= -->
                <!-- TOMBOL KELUAR -->
                <!-- ================================================= -->

                <div class="px-4 pb-4">

                    <button
                        type="button"
                        onclick="openLogoutModal()"
                        class="w-full
                               flex
                               items-center
                               justify-center
                               gap-2
                               px-3
                               py-2
                               rounded-lg
                               bg-red-50
                               text-red-500
                               text-[10px]
                               font-medium
                               hover:bg-red-100
                               transition">

                        <i
                            class="fa-solid fa-right-from-bracket text-[9px]">
                        </i>

                        Keluar

                    </button>

                </div>


            </div>


        </div>

    </div>



    <!-- ================================================= -->
    <!-- MODAL KONFIRMASI LOGOUT -->
    <!-- ================================================= -->

    <div
        id="logoutModal"
        class="hidden
               fixed
               inset-0
               bg-black/50
               backdrop-blur-sm
               flex
               items-center
               justify-center
               z-[99999]
               px-4">


        <!-- ================================================= -->
        <!-- MODAL -->
        <!-- ================================================= -->

        <div
            class="bg-white
                   w-full
                   max-w-sm
                   rounded-xl
                   shadow-2xl
                   overflow-hidden">


            <!-- ================================================= -->
            <!-- ICON -->
            <!-- ================================================= -->

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



            <!-- ================================================= -->
            <!-- INFORMASI -->
            <!-- ================================================= -->

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



                <!-- ================================================= -->
                <!-- USER -->
                <!-- ================================================= -->

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



                    <!-- INFO USER -->

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



            <!-- ================================================= -->
            <!-- BUTTON MODAL -->
            <!-- ================================================= -->

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



    <!-- ================================================= -->
    <!-- JAVASCRIPT -->
    <!-- ================================================= -->

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


        // Klik area gelap untuk menutup modal

        document
            .getElementById('logoutModal')
            .addEventListener('click', function(event) {

                if (event.target === this) {

                    closeLogoutModal();

                }

            });


        // Tekan ESC untuk menutup modal

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {

                closeLogoutModal();

            }

        });

    </script>


</body>

</html>