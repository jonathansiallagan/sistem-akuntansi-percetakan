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
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin(Request $request)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | ROLE USER
        |--------------------------------------------------------------------------
        */

        $isAdminPusat = $user->role === 'Admin Pusat';

        /*
        |--------------------------------------------------------------------------
        | DAFTAR CABANG
        |--------------------------------------------------------------------------
        */

        $semuaCabang = Cabang::orderBy('nama')->get();

        /*
        |--------------------------------------------------------------------------
        | FILTER CABANG
        |--------------------------------------------------------------------------
        */

        if ($isAdminPusat) {

            $cabangId = $request->get('cabang');

            if ($cabangId === 'semua' || $cabangId === null || $cabangId === '') {
                $cabangId = null;
            }

        } else {

            // Admin cabang hanya boleh melihat cabangnya sendiri
            $cabangId = $user->cabang_id;
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        $tanggal = $request->get(
            'tanggal',
            Carbon::today()->format('Y-m-d')
        );


        /*
        |--------------------------------------------------------------------------
        | INFORMASI CABANG USER
        |--------------------------------------------------------------------------
        */

        $namaCabang = 'Seluruh Cabang';

        if (!$isAdminPusat && $user->cabang) {
            $namaCabang = $user->cabang->nama;
        }


        /*
        |--------------------------------------------------------------------------
        | JUDUL DASHBOARD
        |--------------------------------------------------------------------------
        */

        $judulDashboard = $isAdminPusat
            ? 'Dashboard Admin Pusat'
            : 'Dashboard Admin Cabang';


        $subJudul = $isAdminPusat
            ? 'Ringkasan aktivitas seluruh cabang.'
            : 'Ringkasan aktivitas ' . $namaCabang . '.';


        /*
        |--------------------------------------------------------------------------
        | QUERY TRANSAKSI
        |--------------------------------------------------------------------------
        */

        $transaksiQuery = Transaksi::query()
            ->whereDate('tanggal', $tanggal);


        if ($cabangId !== null) {
            $transaksiQuery->where('cabang_id', $cabangId);
        }


        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI HARI INI / TANGGAL TERPILIH
        |--------------------------------------------------------------------------
        */

        $jumlahTransaksi = (clone $transaksiQuery)->count();

        $omzet = (clone $transaksiQuery)->sum('total_transaksi');

        $totalHpp = (clone $transaksiQuery)->sum('total_hpp');

        $laba = $omzet - $totalHpp;


        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI TERBARU
        |--------------------------------------------------------------------------
        */

        $transaksiTerbaru = (clone $transaksiQuery)
            ->with([
                'cabang',
                'user',
                'detailTransaksis.produk'
            ])
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TOTAL DATA MASTER
        |--------------------------------------------------------------------------
        */

        $totalCabang = $isAdminPusat
            ? Cabang::count()
            : 1;


        $cabangAktif = $isAdminPusat
            ? Cabang::where('status', 'aktif')->count()
            : Cabang::where('id', $user->cabang_id)
                ->where('status', 'aktif')
                ->count();


        $totalUser = $isAdminPusat
            ? User::count()
            : User::where('cabang_id', $user->cabang_id)->count();


        $totalProduk = Produk::count();

        $totalAkun = Akun::count();

        $akunAktif = Akun::where('status', 'aktif')->count();

        $totalJurnal = $isAdminPusat
            ? Jurnal::count()
            : Jurnal::where('cabang_id', $user->cabang_id)->count();


        /*
        |--------------------------------------------------------------------------
        | PRODUK TERLARIS
        |--------------------------------------------------------------------------
        */

        $produkTerlarisQuery = DetailTransaksi::query()
            ->select('produk_id')
            ->selectRaw('SUM(jumlah) as total_terjual')
            ->selectRaw('SUM(subtotal) as total_penjualan')
            ->whereHas('transaksi', function ($query) use ($tanggal, $cabangId) {

                $query->whereDate('tanggal', $tanggal);

                if ($cabangId !== null) {
                    $query->where('cabang_id', $cabangId);
                }
            })
            ->with('produk')
            ->groupBy('produk_id')
            ->orderByDesc('total_terjual')
            ->limit(5);


        $produkTerlaris = $produkTerlarisQuery->get();


        /*
        |--------------------------------------------------------------------------
        | JURNAL TERBARU
        |--------------------------------------------------------------------------
        */

        $jurnalQuery = Jurnal::query();

        if (!$isAdminPusat) {
            $jurnalQuery->where('cabang_id', $user->cabang_id);
        }

        $jurnalTerbaru = $jurnalQuery
            ->with([
                'cabang',
                'user',
                'detailJurnals.akun'
            ])
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TOTAL DEBIT & KREDIT
        |--------------------------------------------------------------------------
        */

        $totalDebit = 0;
        $totalKredit = 0;

        foreach ($jurnalTerbaru as $jurnal) {

            foreach ($jurnal->detailJurnals as $detail) {

                $totalDebit += (float) $detail->debit;

                $totalKredit += (float) $detail->kredit;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DATA GRAFIK 7 HARI TERAKHIR
        |--------------------------------------------------------------------------
        */

        $chartLabels = [];
        $chartData = [];

        for ($i = 6; $i >= 0; $i--) {

            $hari = Carbon::parse($tanggal)->subDays($i);

            $chartLabels[] = $hari->translatedFormat('d M');


            $queryGrafik = Transaksi::query()
                ->whereDate('tanggal', $hari->format('Y-m-d'));


            if ($cabangId !== null) {
                $queryGrafik->where('cabang_id', $cabangId);
            }


            $pendapatanHari = $queryGrafik->sum('total_transaksi');


            $chartData[] = (float) $pendapatanHari;
        }


        /*
        |--------------------------------------------------------------------------
        | RINGKASAN CABANG
        |--------------------------------------------------------------------------
        */

        $ringkasanCabangQuery = Cabang::query();

        if (!$isAdminPusat) {
            $ringkasanCabangQuery->where('id', $user->cabang_id);
        }


        $ringkasanCabang = $ringkasanCabangQuery
            ->withCount('transaksis')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PENDAPATAN & LABA PER CABANG
        |--------------------------------------------------------------------------
        */

        foreach ($ringkasanCabang as $cabang) {

            $queryCabang = Transaksi::query()
                ->where('cabang_id', $cabang->id)
                ->whereDate('tanggal', $tanggal);


            $cabang->pendapatan = (float) $queryCabang->sum('total_transaksi');

            $cabang->hpp = (float) $queryCabang->sum('total_hpp');

            $cabang->laba = $cabang->pendapatan - $cabang->hpp;
        }


        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(

            'judulDashboard',
            'subJudul',

            'isAdminPusat',

            'namaCabang',

            'semuaCabang',
            'cabangId',
            'tanggal',

            'totalCabang',
            'cabangAktif',
            'totalUser',
            'totalProduk',
            'totalAkun',
            'akunAktif',
            'totalJurnal',

            'jumlahTransaksi',
            'omzet',
            'totalHpp',
            'laba',

            'transaksiTerbaru',
            'produkTerlaris',
            'jurnalTerbaru',

            'totalDebit',
            'totalKredit',

            'chartLabels',
            'chartData',

            'ringkasanCabang'
        ));
    }


    public function kasir()
    {
        return view('kasir.kasir');
    }
}