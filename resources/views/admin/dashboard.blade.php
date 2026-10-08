<x-admin-layout>

    {{-- HEADER --}}
    <div class="mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $judulDashboard }}
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $subJudul }}
                </p>
            </div>

            {{-- FILTER --}}
            <form method="GET" action="{{ route('admin') }}"
                  class="flex flex-wrap items-center gap-2">

                @if($isAdminPusat)
                    <select name="cabang"
                            class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white">

                        <option value="semua">
                            Semua Cabang
                        </option>

                        @foreach($semuaCabang as $cabang)
                            <option value="{{ $cabang->id }}"
                                {{ (string) $cabangId === (string) $cabang->id ? 'selected' : '' }}>
                                {{ $cabang->nama }}
                            </option>
                        @endforeach

                    </select>
                @endif

                <input
                    type="date"
                    name="tanggal"
                    value="{{ $tanggal }}"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white"
                >

                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium">
                    Terapkan
                </button>

            </form>

        </div>
    </div>


    {{-- ===================================================== --}}
    {{-- STATISTIK UTAMA --}}
    {{-- ===================================================== --}}

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

        {{-- OMZET --}}
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Omzet
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800 mt-2">
                        Rp {{ number_format($omzet, 0, ',', '.') }}
                    </h2>
                </div>

                <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>

            </div>
        </div>


        {{-- TRANSAKSI --}}
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Transaksi
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800 mt-2">
                        {{ number_format($jumlahTransaksi, 0, ',', '.') }}
                    </h2>
                </div>

                <div class="w-11 h-11 rounded-xl bg-green-50 text-green-600 flex items-center justify-center">
                    <i class="fa-solid fa-receipt"></i>
                </div>

            </div>
        </div>


        {{-- HPP --}}
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        HPP
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800 mt-2">
                        Rp {{ number_format($totalHpp, 0, ',', '.') }}
                    </h2>
                </div>

                <div class="w-11 h-11 rounded-xl bg-red-50 text-red-600 flex items-center justify-center">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>

            </div>
        </div>


        {{-- LABA --}}
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Laba Kotor
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800 mt-2">
                        Rp {{ number_format($laba, 0, ',', '.') }}
                    </h2>

                    <p class="text-xs text-gray-400 mt-1">
                        Omzet - HPP
                    </p>
                </div>

                <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <i class="fa-solid fa-chart-line"></i>
                </div>

            </div>
        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- MASTER DATA --}}
    {{-- ===================================================== --}}

    @if($isAdminPusat)

        <div class="mb-6">

            <div class="mb-4">
                <h2 class="text-lg font-bold text-gray-800">
                    Ringkasan Master Data
                </h2>

                <p class="text-sm text-gray-500">
                    Data yang tersedia dalam sistem.
                </p>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

                {{-- CABANG --}}
                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <div class="flex items-center gap-4">

                        <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                            <i class="fa-solid fa-store"></i>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Total Cabang
                            </p>

                            <p class="text-xl font-bold text-gray-800">
                                {{ number_format($totalCabang, 0, ',', '.') }}
                            </p>
                        </div>

                    </div>
                </div>


                {{-- USER --}}
                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <div class="flex items-center gap-4">

                        <div class="w-10 h-10 rounded-lg bg-green-50 text-green-600 flex items-center justify-center">
                            <i class="fa-solid fa-users"></i>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Total User
                            </p>

                            <p class="text-xl font-bold text-gray-800">
                                {{ number_format($totalUser, 0, ',', '.') }}
                            </p>
                        </div>

                    </div>
                </div>


                {{-- PRODUK --}}
                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <div class="flex items-center gap-4">

                        <div class="w-10 h-10 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center">
                            <i class="fa-solid fa-box"></i>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Total Produk
                            </p>

                            <p class="text-xl font-bold text-gray-800">
                                {{ number_format($totalProduk, 0, ',', '.') }}
                            </p>
                        </div>

                    </div>
                </div>


                {{-- AKUN --}}
                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <div class="flex items-center gap-4">

                        <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                            <i class="fa-solid fa-list"></i>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Total Akun
                            </p>

                            <p class="text-xl font-bold text-gray-800">
                                {{ number_format($totalAkun, 0, ',', '.') }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- GRAFIK + PRODUK TERLARIS --}}
    {{-- ===================================================== --}}

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

        {{-- GRAFIK --}}
        <div class="xl:col-span-2 bg-white border border-gray-200 rounded-xl p-6 shadow-sm">

            <div class="mb-5">
                <h2 class="text-lg font-bold text-gray-800">
                    Grafik Omzet
                </h2>

                <p class="text-sm text-gray-500">
                    Omzet 7 hari terakhir.
                </p>
            </div>

            <div class="relative h-[300px]">
                <canvas id="omzetChart"></canvas>
            </div>

        </div>


        {{-- PRODUK TERLARIS --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">

            <div class="mb-5">
                <h2 class="text-lg font-bold text-gray-800">
                    Produk Terlaris
                </h2>

                <p class="text-sm text-gray-500">
                    Berdasarkan jumlah produk terjual.
                </p>
            </div>


            <div class="space-y-4">

                @forelse($produkTerlaris as $produk)

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-3 min-w-0">

                            <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-box"></i>
                            </div>

                            <div class="min-w-0">

                                <p class="text-sm font-semibold text-gray-800 truncate">
                                    {{ $produk->produk->nama ?? 'Produk' }}
                                </p>

                                <p class="text-xs text-gray-400">
                                    {{ number_format($produk->total_terjual, 0, ',', '.') }} terjual
                                </p>

                            </div>

                        </div>

                        <span class="text-sm font-bold text-gray-700">
                            {{ number_format($produk->total_terjual, 0, ',', '.') }}
                        </span>

                    </div>

                @empty

                    <div class="text-center py-10">

                        <i class="fa-solid fa-box-open text-3xl text-gray-300 mb-3"></i>

                        <p class="text-sm text-gray-400">
                            Belum ada data produk.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- TRANSAKSI TERBARU --}}
    {{-- ===================================================== --}}

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-6">

        <div class="px-6 py-5 border-b border-gray-200">

            <h2 class="text-lg font-bold text-gray-800">
                Transaksi Terbaru
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Transaksi pada tanggal {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}.
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        <th class="text-left px-6 py-4 font-semibold text-gray-600">
                            Invoice
                        </th>

                        <th class="text-left px-6 py-4 font-semibold text-gray-600">
                            Tanggal
                        </th>

                        <th class="text-left px-6 py-4 font-semibold text-gray-600">
                            Pelanggan
                        </th>

                        <th class="text-left px-6 py-4 font-semibold text-gray-600">
                            Cabang
                        </th>

                        <th class="text-right px-6 py-4 font-semibold text-gray-600">
                            Omzet
                        </th>

                        <th class="text-right px-6 py-4 font-semibold text-gray-600">
                            HPP
                        </th>

                        <th class="text-right px-6 py-4 font-semibold text-gray-600">
                            Laba
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($transaksiTerbaru as $transaksi)

                        @php
                            $omzetTransaksi = (float) $transaksi->total_transaksi;
                            $hppTransaksi = (float) $transaksi->total_hpp;
                            $labaTransaksi = $omzetTransaksi - $hppTransaksi;
                        @endphp

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-semibold text-blue-600">
                                {{ $transaksi->no_invoice ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d/m/Y') }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $transaksi->nama_pelanggan ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $transaksi->cabang->nama ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-right font-semibold text-gray-800">
                                Rp {{ number_format($omzetTransaksi, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-right text-red-600">
                                Rp {{ number_format($hppTransaksi, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-right font-semibold text-green-600">
                                Rp {{ number_format($labaTransaksi, 0, ',', '.') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="px-6 py-10 text-center">

                                <i class="fa-solid fa-receipt text-3xl text-gray-300 mb-3"></i>

                                <p class="text-sm text-gray-400">
                                    Belum ada transaksi pada tanggal ini.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- RINGKASAN CABANG --}}
    {{-- ===================================================== --}}

    @if($isAdminPusat)

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-6">

            <div class="px-6 py-5 border-b border-gray-200">

                <h2 class="text-lg font-bold text-gray-800">
                    Ringkasan Cabang
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Performa masing-masing cabang.
                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50 border-b border-gray-200">

                        <tr>

                            <th class="text-left px-6 py-4 font-semibold text-gray-600">
                                Cabang
                            </th>

                            <th class="text-center px-6 py-4 font-semibold text-gray-600">
                                Transaksi
                            </th>

                            <th class="text-right px-6 py-4 font-semibold text-gray-600">
                                Omzet
                            </th>

                            <th class="text-right px-6 py-4 font-semibold text-gray-600">
                                HPP
                            </th>

                            <th class="text-right px-6 py-4 font-semibold text-gray-600">
                                Laba
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse($ringkasanCabang as $cabang)

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    {{ $cabang->nama }}
                                </td>

                                <td class="px-6 py-4 text-center text-gray-600">
                                    {{ number_format($cabang->transaksis_count ?? 0, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-right font-semibold text-gray-800">
                                    Rp {{ number_format($cabang->pendapatan ?? 0, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-right text-red-600">
                                    Rp {{ number_format($cabang->hpp ?? 0, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-right font-semibold text-green-600">
                                    Rp {{ number_format($cabang->laba ?? 0, 0, ',', '.') }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                    Belum ada data cabang.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- JURNAL TERBARU --}}
    {{-- ===================================================== --}}

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

        <div class="xl:col-span-2 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200">

                <h2 class="text-lg font-bold text-gray-800">
                    Jurnal Terbaru
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Data jurnal yang tercatat.
                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50 border-b border-gray-200">

                        <tr>

                            <th class="text-left px-6 py-4 font-semibold text-gray-600">
                                Tanggal
                            </th>

                            <th class="text-left px-6 py-4 font-semibold text-gray-600">
                                Keterangan
                            </th>

                            <th class="text-left px-6 py-4 font-semibold text-gray-600">
                                Cabang
                            </th>

                            <th class="text-right px-6 py-4 font-semibold text-gray-600">
                                Debit
                            </th>

                            <th class="text-right px-6 py-4 font-semibold text-gray-600">
                                Kredit
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse($jurnalTerbaru as $jurnal)

                            @php
                                $debit = $jurnal->detailJurnals->sum('debit');
                                $kredit = $jurnal->detailJurnals->sum('kredit');
                            @endphp

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 text-gray-600">
                                    {{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $jurnal->keterangan ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $jurnal->cabang->nama ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-right text-blue-600 font-medium">
                                    Rp {{ number_format($debit, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-right text-green-600 font-medium">
                                    Rp {{ number_format($kredit, 0, ',', '.') }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-6 py-10 text-center">

                                    <i class="fa-solid fa-book-open text-3xl text-gray-300 mb-3"></i>

                                    <p class="text-sm text-gray-400">
                                        Belum ada jurnal.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- RINGKASAN DEBIT KREDIT --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">

            <h2 class="text-lg font-bold text-gray-800">
                Ringkasan Jurnal
            </h2>

            <p class="text-sm text-gray-500 mt-1 mb-6">
                Total debit dan kredit.
            </p>


            <div class="space-y-4">

                {{-- DEBIT --}}
                <div class="flex items-center justify-between p-4 rounded-xl bg-blue-50">

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                            <i class="fa-solid fa-arrow-down"></i>
                        </div>

                        <span class="text-sm font-medium text-gray-700">
                            Debit
                        </span>

                    </div>

                    <span class="font-bold text-blue-600">
                        Rp {{ number_format($totalDebit, 0, ',', '.') }}
                    </span>

                </div>


                {{-- KREDIT --}}
                <div class="flex items-center justify-between p-4 rounded-xl bg-green-50">

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                            <i class="fa-solid fa-arrow-up"></i>
                        </div>

                        <span class="text-sm font-medium text-gray-700">
                            Kredit
                        </span>

                    </div>

                    <span class="font-bold text-green-600">
                        Rp {{ number_format($totalKredit, 0, ',', '.') }}
                    </span>

                </div>

            </div>

        </div>

    </div>

</x-admin-layout>


{{-- ===================================================== --}}
{{-- CHART JS --}}
{{-- ===================================================== --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('omzetChart');

    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext('2d');

    const labels = @json($chartLabels);
    const data = @json($chartData);

    new Chart(ctx, {

        type: 'line',

        data: {
            labels: labels,

            datasets: [{
                label: 'Omzet',
                data: data,
                borderWidth: 2,
                tension: 0.35,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
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
                                new Intl.NumberFormat('id-ID')
                                .format(context.raw || 0);

                        }

                    }

                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {

                        callback: function (value) {

                            return 'Rp ' +
                                new Intl.NumberFormat('id-ID')
                                .format(value);

                        }

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

});
</script>