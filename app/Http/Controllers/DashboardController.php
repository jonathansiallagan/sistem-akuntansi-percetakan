<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Cabang;
use App\Models\DetailTransaksi;
use App\Models\Jurnal;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin(Request $request)
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | ROLE
        |--------------------------------------------------------------------------
        */

        $isAdminPusat = $user->role === 'Admin Pusat';
        $isAdminCabang = $user->role === 'Admin Cabang';

        /*
        |--------------------------------------------------------------------------
        | FILTER
        |--------------------------------------------------------------------------
        */

        $tanggal = $request->input(
            'tanggal',
            Carbon::today()->format('Y-m-d')
        );

        $cabangId = null;

        if ($isAdminPusat) {

            $cabangId = $request->input('cabang');

            if ($cabangId === 'semua' || $cabangId === '') {
                $cabangId = null;
            }

        } elseif ($isAdminCabang) {

            $cabangId = $user->cabang_id;
        }

        /*
        |--------------------------------------------------------------------------
        | SEMUA CABANG
        |--------------------------------------------------------------------------
        */

        $semuaCabang = Cabang::orderBy('nama')->get();

        /*
        |--------------------------------------------------------------------------
        | JUDUL DASHBOARD
        |--------------------------------------------------------------------------
        */

        if ($isAdminPusat) {

            $judulDashboard = 'Dashboard Admin Pusat';

            $subjudulDashboard =
                'Pantau seluruh aktivitas dan performa percetakan.';

        } else {

            $judulDashboard = 'Dashboard Admin Cabang';

            $subjudulDashboard =
                'Pantau aktivitas dan performa cabang Anda.';
        }

        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI PADA TANGGAL TERPILIH
        |--------------------------------------------------------------------------
        */

        $transaksiQuery = Transaksi::query()
            ->whereDate('tanggal', $tanggal);

        if ($cabangId !== null) {

            $transaksiQuery->where(
                'cabang_id',
                $cabangId
            );
        }

        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $jumlahTransaksi =
            (clone $transaksiQuery)->count();

        $omzet =
            (clone $transaksiQuery)->sum('total_transaksi');

        $totalHpp =
            (clone $transaksiQuery)->sum('total_hpp');

        $laba =
            $omzet - $totalHpp;

        /*
        |--------------------------------------------------------------------------
        | PERBANDINGAN HARI SEBELUMNYA
        |--------------------------------------------------------------------------
        */

        $tanggalSebelumnya = Carbon::parse($tanggal)
            ->subDay()
            ->format('Y-m-d');

        $transaksiSebelumnyaQuery = Transaksi::query()
            ->whereDate(
                'tanggal',
                $tanggalSebelumnya
            );

        if ($cabangId !== null) {

            $transaksiSebelumnyaQuery->where(
                'cabang_id',
                $cabangId
            );
        }

        $jumlahTransaksiSebelumnya =
            (clone $transaksiSebelumnyaQuery)->count();

        $omzetSebelumnya =
            (clone $transaksiSebelumnyaQuery)
                ->sum('total_transaksi');

        $totalHppSebelumnya =
            (clone $transaksiSebelumnyaQuery)
                ->sum('total_hpp');

        $labaSebelumnya =
            $omzetSebelumnya - $totalHppSebelumnya;

        /*
        |--------------------------------------------------------------------------
        | HITUNG PERSENTASE
        |--------------------------------------------------------------------------
        */

        $hitungPersentase = function (
            $sekarang,
            $sebelumnya
        ) {

            if ((float) $sebelumnya == 0) {

                return $sekarang > 0
                    ? 100
                    : 0;
            }

            return (
                ($sekarang - $sebelumnya)
                / $sebelumnya
            ) * 100;
        };

        $persenOmzet =
            $hitungPersentase(
                $omzet,
                $omzetSebelumnya
            );

        $persenTransaksi =
            $hitungPersentase(
                $jumlahTransaksi,
                $jumlahTransaksiSebelumnya
            );

        $persenHpp =
            $hitungPersentase(
                $totalHpp,
                $totalHppSebelumnya
            );

        $persenLaba =
            $hitungPersentase(
                $laba,
                $labaSebelumnya
            );

        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI TERBARU
        |--------------------------------------------------------------------------
        */

        $transaksiTerbaru =
            (clone $transaksiQuery)
                ->with([
                    'cabang',
                    'user',
                    'detailTransaksis.produk',
                ])
                ->orderByDesc('tanggal')
                ->orderByDesc('id')
                ->limit(5)
                ->get();

        /*
        |--------------------------------------------------------------------------
        | DATA MASTER
        |--------------------------------------------------------------------------
        */

        $totalCabang = $isAdminPusat
            ? Cabang::count()
            : 1;

        $totalUser = $isAdminPusat
            ? User::count()
            : User::where(
                'cabang_id',
                $user->cabang_id
            )->count();

        $totalProduk =
            Produk::count();

        $totalAkun =
            Akun::count();

        /*
        |--------------------------------------------------------------------------
        | PRODUK TERLARIS
        |--------------------------------------------------------------------------
        |
        | detail_transaksis:
        | - produk_id
        | - jumlah
        | - subtotal
        |
        */

        $produkTerlarisQuery =
            DetailTransaksi::query()
                ->select('produk_id')
                ->selectRaw(
                    'SUM(jumlah) as total_terjual'
                )
                ->selectRaw(
                    'SUM(subtotal) as total_penjualan'
                )
                ->whereHas(
                    'transaksi',
                    function ($query) use (
                        $tanggal,
                        $cabangId
                    ) {

                        $query->whereDate(
                            'tanggal',
                            $tanggal
                        );

                        if ($cabangId !== null) {

                            $query->where(
                                'cabang_id',
                                $cabangId
                            );
                        }
                    }
                )
                ->with('produk')
                ->groupBy('produk_id')
                ->orderByDesc('total_terjual')
                ->limit(5);

        $produkTerlaris =
            $produkTerlarisQuery->get();

        /*
        |--------------------------------------------------------------------------
        | JURNAL TERBARU
        |--------------------------------------------------------------------------
        */

        $jurnalQuery =
            Jurnal::query();

        if ($cabangId !== null) {

            $jurnalQuery->where(
                'cabang_id',
                $cabangId
            );
        }

        $jurnalTerbaru =
            $jurnalQuery
                ->with([
                    'cabang',
                    'user',
                    'detailJurnals.akun',
                ])
                ->orderByDesc('tanggal')
                ->orderByDesc('id')
                ->limit(5)
                ->get();

        /*
        |--------------------------------------------------------------------------
        | TOTAL DEBIT DAN KREDIT
        |--------------------------------------------------------------------------
        */

        $totalDebit = 0;
        $totalKredit = 0;

        foreach ($jurnalTerbaru as $jurnal) {

            foreach (
                $jurnal->detailJurnals
                as $detail
            ) {

                $totalDebit +=
                    (float) $detail->debit;

                $totalKredit +=
                    (float) $detail->kredit;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CHART OMZET 7 HARI
        |--------------------------------------------------------------------------
        */

        $tanggalChart = [];

        $omzetChart = [];

        for ($i = 6; $i >= 0; $i--) {

            $hari =
                Carbon::parse($tanggal)
                    ->subDays($i);

            $tanggalChart[] =
                $hari->translatedFormat('d M');

            $queryGrafik =
                Transaksi::query()
                    ->whereDate(
                        'tanggal',
                        $hari->format('Y-m-d')
                    );

            if ($cabangId !== null) {

                $queryGrafik->where(
                    'cabang_id',
                    $cabangId
                );
            }

            $pendapatanHari =
                $queryGrafik->sum(
                    'total_transaksi'
                );

            $omzetChart[] =
                (float) $pendapatanHari;
        }

        /*
        |--------------------------------------------------------------------------
        | RINGKASAN CABANG
        |--------------------------------------------------------------------------
        */

        $ringkasanCabang =
            collect();

        if ($isAdminPusat) {

            $ringkasanCabang =
                Cabang::query()
                    ->withCount([
                        'transaksis as jumlah_transaksi'
                            => function ($query) use (
                                $tanggal
                            ) {

                                $query->whereDate(
                                    'tanggal',
                                    $tanggal
                                );
                            },
                    ])
                    ->withSum([
                        'transaksis as omzet'
                            => function ($query) use (
                                $tanggal
                            ) {

                                $query->whereDate(
                                    'tanggal',
                                    $tanggal
                                );
                            },
                    ], 'total_transaksi')
                    ->withSum([
                        'transaksis as hpp'
                            => function ($query) use (
                                $tanggal
                            ) {

                                $query->whereDate(
                                    'tanggal',
                                    $tanggal
                                );
                            },
                    ], 'total_hpp')
                    ->get();

            foreach (
                $ringkasanCabang
                as $cabang
            ) {

                $cabang->laba =
                    ($cabang->omzet ?? 0)
                    -
                    ($cabang->hpp ?? 0);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard',
            compact(
                'isAdminPusat',
                'isAdminCabang',

                'judulDashboard',
                'subjudulDashboard',

                'tanggal',
                'cabangId',
                'semuaCabang',

                'jumlahTransaksi',
                'omzet',
                'totalHpp',
                'laba',

                'persenOmzet',
                'persenTransaksi',
                'persenHpp',
                'persenLaba',

                'transaksiTerbaru',

                'totalCabang',
                'totalUser',
                'totalProduk',
                'totalAkun',

                'produkTerlaris',

                'jurnalTerbaru',

                'totalDebit',
                'totalKredit',

                'tanggalChart',
                'omzetChart',

                'ringkasanCabang'
            )
        );
    }

    public function kasir()
    {
        return view('kasir.index');
    }
}