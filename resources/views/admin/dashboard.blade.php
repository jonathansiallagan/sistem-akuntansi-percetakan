<x-admin-layout>

    {{-- HEADER --}}
    <div class="mb-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>

                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $judulDashboard }}
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $subjudulDashboard }}
                </p>

            </div>


            {{-- FILTER --}}
            <form
                method="GET"
                action="{{ route('admin') }}"
                class="flex flex-col sm:flex-row gap-3"
            >

                @if($isAdminPusat)

                    <select
                        name="cabang"
                        onchange="this.form.submit()"
                        class="border border-gray-200 rounded-lg px-4 py-2 text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >

                        <option value="semua">
                            Semua Cabang
                        </option>

                        @foreach($semuaCabang as $cabang)

                            <option
                                value="{{ $cabang->id }}"
                                {{ (string) $cabangId === (string) $cabang->id ? 'selected' : '' }}
                            >
                                {{ $cabang->nama }}
                            </option>

                        @endforeach

                    </select>

                @endif


                <input
                    type="date"
                    name="tanggal"
                    value="{{ $tanggal }}"
                    onchange="this.form.submit()"
                    class="border border-gray-200 rounded-lg px-4 py-2 text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >

            </form>

        </div>

    </div>


    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">


        {{-- OMZET --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Omzet
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800 mt-1">
                        Rp {{ number_format($omzet, 0, ',', '.') }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-lg bg-blue-50 flex items-center justify-center">

                    <i class="fa-solid fa-money-bill-trend-up text-blue-600"></i>

                </div>

            </div>


            <div class="mt-3 flex items-center gap-2">

                <span
                    class="text-xs font-semibold px-2 py-1 rounded-md
                    {{ $persenOmzet >= 0
                        ? 'text-green-600 bg-green-50'
                        : 'text-red-600 bg-red-50' }}"
                >

                    {{ $persenOmzet >= 0 ? '↑' : '↓' }}

                    {{ number_format(abs($persenOmzet), 1, ',', '.') }}%

                </span>

                <span class="text-xs text-gray-400">
                    dari hari sebelumnya
                </span>

            </div>

        </div>


        {{-- TRANSAKSI --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Transaksi
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800 mt-1">
                        {{ number_format($jumlahTransaksi, 0, ',', '.') }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-lg bg-purple-50 flex items-center justify-center">

                    <i class="fa-solid fa-receipt text-purple-600"></i>

                </div>

            </div>


            <div class="mt-3 flex items-center gap-2">

                <span
                    class="text-xs font-semibold px-2 py-1 rounded-md
                    {{ $persenTransaksi >= 0
                        ? 'text-green-600 bg-green-50'
                        : 'text-red-600 bg-red-50' }}"
                >

                    {{ $persenTransaksi >= 0 ? '↑' : '↓' }}

                    {{ number_format(abs($persenTransaksi), 1, ',', '.') }}%

                </span>

                <span class="text-xs text-gray-400">
                    dari hari sebelumnya
                </span>

            </div>

        </div>


        {{-- HPP --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        HPP
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800 mt-1">
                        Rp {{ number_format($totalHpp, 0, ',', '.') }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-lg bg-orange-50 flex items-center justify-center">

                    <i class="fa-solid fa-boxes-stacked text-orange-600"></i>

                </div>

            </div>


            <div class="mt-3 flex items-center gap-2">

                <span
                    class="text-xs font-semibold px-2 py-1 rounded-md
                    {{ $persenHpp <= 0
                        ? 'text-green-600 bg-green-50'
                        : 'text-red-600 bg-red-50' }}"
                >

                    {{ $persenHpp >= 0 ? '↑' : '↓' }}

                    {{ number_format(abs($persenHpp), 1, ',', '.') }}%

                </span>

                <span class="text-xs text-gray-400">
                    dari hari sebelumnya
                </span>

            </div>

        </div>


        {{-- LABA --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Laba Kotor
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800 mt-1">
                        Rp {{ number_format($laba, 0, ',', '.') }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-lg bg-green-50 flex items-center justify-center">

                    <i class="fa-solid fa-chart-line text-green-600"></i>

                </div>

            </div>


            <div class="mt-3 flex items-center gap-2">

                <span
                    class="text-xs font-semibold px-2 py-1 rounded-md
                    {{ $persenLaba >= 0
                        ? 'text-green-600 bg-green-50'
                        : 'text-red-600 bg-red-50' }}"
                >

                    {{ $persenLaba >= 0 ? '↑' : '↓' }}

                    {{ number_format(abs($persenLaba), 1, ',', '.') }}%

                </span>

                <span class="text-xs text-gray-400">
                    dari hari sebelumnya
                </span>

            </div>

        </div>

    </div>


    {{-- CHART + PRODUK TERLARIS --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 mb-6">


        {{-- CHART --}}
        <div class="xl:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-5">

            <div class="mb-5">

                <h2 class="font-semibold text-gray-800">
                    Performa Omzet
                </h2>

                <p class="text-xs text-gray-400 mt-1">
                    Perkembangan omzet 7 hari terakhir
                </p>

            </div>

            <div class="h-80">

                <canvas id="omzetChart"></canvas>

            </div>

        </div>


        {{-- PRODUK TERLARIS --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">

            <div class="mb-5">

                <h2 class="font-semibold text-gray-800">
                    Produk Terlaris
                </h2>

                <p class="text-xs text-gray-400 mt-1">
                    Produk dengan penjualan terbanyak
                </p>

            </div>


            <div class="space-y-4">

                @forelse($produkTerlaris as $index => $produk)

                    <div class="flex items-center gap-3">

                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">

                            {{ $index + 1 }}

                        </div>


                        <div class="flex-1 min-w-0">

                            <p class="text-sm font-medium text-gray-800 truncate">

                                {{ $produk->nama_produk }}

                            </p>

                            <p class="text-xs text-gray-400">

                                {{ number_format($produk->total_qty, 0, ',', '.') }}
                                terjual

                            </p>

                        </div>


                        <div class="text-xs font-semibold text-gray-600">

                            Rp
                            {{ number_format($produk->total_penjualan, 0, ',', '.') }}

                        </div>

                    </div>

                @empty

                    <div class="text-center py-10">

                        <i class="fa-solid fa-box-open text-3xl text-gray-300 mb-3"></i>

                        <p class="text-sm text-gray-400">
                            Belum ada data produk
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- TRANSAKSI TERBARU --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm mb-6">

        <div class="p-5 border-b border-gray-100">

            <h2 class="font-semibold text-gray-800">
                Transaksi Terbaru
            </h2>

            <p class="text-xs text-gray-400 mt-1">

                Transaksi pada tanggal
                {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}

            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-500">

                    <tr>

                        <th class="text-left px-5 py-3 font-medium">
                            #
                        </th>

                        <th class="text-left px-5 py-3 font-medium">
                            Tanggal
                        </th>

                        <th class="text-left px-5 py-3 font-medium">
                            Cabang
                        </th>

                        <th class="text-left px-5 py-3 font-medium">
                            User
                        </th>

                        <th class="text-right px-5 py-3 font-medium">
                            Omzet
                        </th>

                        <th class="text-right px-5 py-3 font-medium">
                            HPP
                        </th>

                        <th class="text-right px-5 py-3 font-medium">
                            Laba
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($transaksiTerbaru as $index => $transaksi)

                        @php

                            $labaTransaksi =
                                $transaksi->total_transaksi
                                -
                                $transaksi->total_hpp;

                        @endphp


                        <tr class="hover:bg-gray-50">

                            <td class="px-5 py-4 text-gray-500">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-5 py-4 text-gray-700">

                                {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d/m/Y') }}

                            </td>

                            <td class="px-5 py-4 text-gray-700">

                                {{ $transaksi->cabang->nama ?? '-' }}

                            </td>

                            <td class="px-5 py-4 text-gray-700">

                                {{ $transaksi->user->name ?? '-' }}

                            </td>

                            <td class="px-5 py-4 text-right font-medium text-gray-800">

                                Rp
                                {{ number_format($transaksi->total_transaksi, 0, ',', '.') }}

                            </td>

                            <td class="px-5 py-4 text-right text-gray-600">

                                Rp
                                {{ number_format($transaksi->total_hpp, 0, ',', '.') }}

                            </td>

                            <td class="px-5 py-4 text-right font-medium text-green-600">

                                Rp
                                {{ number_format($labaTransaksi, 0, ',', '.') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-5 py-10 text-center"
                            >

                                <i class="fa-solid fa-receipt text-3xl text-gray-300 mb-3"></i>

                                <p class="text-sm text-gray-400">
                                    Belum ada transaksi
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- JURNAL --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">


        {{-- JURNAL TERBARU --}}
        <div class="xl:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm">

            <div class="p-5 border-b border-gray-100">

                <h2 class="font-semibold text-gray-800">
                    Jurnal Terbaru
                </h2>

                <p class="text-xs text-gray-400 mt-1">
                    Jurnal pada tanggal terpilih
                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-gray-500">

                        <tr>

                            <th class="text-left px-5 py-3 font-medium">
                                Tanggal
                            </th>

                            <th class="text-left px-5 py-3 font-medium">
                                Keterangan
                            </th>

                            @if($isAdminPusat)

                                <th class="text-left px-5 py-3 font-medium">
                                    Cabang
                                </th>

                            @endif

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse($jurnalTerbaru as $jurnal)

                            <tr class="hover:bg-gray-50">

                                <td class="px-5 py-4 text-gray-600">

                                    {{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}

                                </td>

                                <td class="px-5 py-4 text-gray-800">

                                    {{ $jurnal->keterangan ?? '-' }}

                                </td>

                                @if($isAdminPusat)

                                    <td class="px-5 py-4 text-gray-600">

                                        {{ $jurnal->nama_cabang ?? '-' }}

                                    </td>

                                @endif

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="{{ $isAdminPusat ? 3 : 2 }}"
                                    class="px-5 py-10 text-center"
                                >

                                    <i class="fa-solid fa-book-open text-3xl text-gray-300 mb-3"></i>

                                    <p class="text-sm text-gray-400">
                                        Belum ada jurnal
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- RINGKASAN JURNAL --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">

            <div class="p-5 border-b border-gray-100">

                <h2 class="font-semibold text-gray-800">
                    Ringkasan Jurnal
                </h2>

                <p class="text-xs text-gray-400 mt-1">
                    Total debit dan kredit
                </p>

            </div>


            <div class="p-5 space-y-4">


                {{-- DEBIT --}}
                <div class="flex items-center p-4 rounded-lg bg-green-50">

                    <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mr-3">

                        <i class="fa-solid fa-arrow-down text-green-600"></i>

                    </div>


                    <div>

                        <p class="text-xs text-gray-500">
                            Total Debit
                        </p>

                        <p class="font-semibold text-gray-800">

                            Rp
                            {{ number_format($totalDebit, 0, ',', '.') }}

                        </p>

                    </div>

                </div>


                {{-- KREDIT --}}
                <div class="flex items-center p-4 rounded-lg bg-blue-50">

                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">

                        <i class="fa-solid fa-arrow-up text-blue-600"></i>

                    </div>


                    <div>

                        <p class="text-xs text-gray-500">
                            Total Kredit
                        </p>

                        <p class="font-semibold text-gray-800">

                            Rp
                            {{ number_format($totalKredit, 0, ',', '.') }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- CHART JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const canvas =
                    document.getElementById('omzetChart');

                if (!canvas) {
                    return;
                }

                const ctx =
                    canvas.getContext('2d');


                new Chart(ctx, {

                    type: 'line',

                    data: {

                        labels:
                            @json($tanggalChart),

                        datasets: [

                            {

                                label: 'Omzet',

                                data:
                                    @json($omzetChart),

                                borderWidth: 3,

                                tension: 0.4,

                                fill: true,

                                pointRadius: 4,

                                pointHoverRadius: 6

                            }

                        ]

                    },


                    options: {

                        responsive: true,

                        maintainAspectRatio: false,


                        plugins: {

                            legend: {
                                display: false
                            },


                            tooltip: {

                                callbacks: {

                                    label: function (context) {

                                        return 'Rp ' +
                                            new Intl.NumberFormat(
                                                'id-ID'
                                            ).format(
                                                context.raw
                                            );

                                    }

                                }

                            }

                        },


                        scales: {

                            y: {

                                beginAtZero: true,

                                ticks: {

                                    callback:
                                        function (value) {

                                            return 'Rp ' +
                                                new Intl.NumberFormat(
                                                    'id-ID'
                                                ).format(
                                                    value
                                                );

                                        }

                                },

                                grid: {

                                    color: '#f3f4f6'

                                }

                            },


                            x: {

                                grid: {

                                    display: false

                                }

                            }

                        }

                    }

                });

            }

        );

    </script>

</x-admin-layout>