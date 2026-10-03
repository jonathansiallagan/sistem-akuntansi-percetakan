<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin(Request $request)
    {
        $cabang  = $request->get('cabang', 'Semua Cabang');
        $tanggal = $request->get('tanggal', date('Y-m-d'));

        // Ambil daftar kolom
        $columns = Schema::getColumnListing('transaksis');

        // Cari kolom uang (coba beberapa kemungkinan)
        $possibleMoney = ['nominal', 'total', 'total_harga', 'jumlah', 'harga', 'nilai', 'grand_total', 'subtotal', 'harga_total'];
        $kolomUang = collect($possibleMoney)->first(fn($col) => in_array($col, $columns));

        // Cari kolom cabang
        $possibleCabang = ['cabang', 'nama_cabang', 'branch', 'cabang_id'];
        $kolomCabang = collect($possibleCabang)->first(fn($col) => in_array($col, $columns)) ?? 'cabang';

        // Query dasar
        $query = Transaksi::query()->whereDate('created_at', $tanggal);

        if ($cabang && $cabang !== 'Semua Cabang' && $kolomCabang) {
            $query->where($kolomCabang, $cabang);
        }

        // 5 transaksi terbaru
        $transaksiTerbaru = (clone $query)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Statistik
        $omzet = 0;
        $jumlahTransaksi = (clone $query)->count();

        if ($kolomUang) {
            $omzet = (clone $query)->sum($kolomUang) ?? 0;
        }

        $laba = $omzet * 0.33;

        // Data Chart
        $chartLabels = [];
        $chartData   = [];

        for ($h = 8; $h <= 16; $h++) {
            $jam = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';
            $chartLabels[] = $jam;

            $start = Carbon::parse($tanggal)->setTime($h, 0, 0);
            $end   = Carbon::parse($tanggal)->setTime($h, 59, 59);

            $sum = 0;
            if ($kolomUang) {
                $sum = Transaksi::whereBetween('created_at', [$start, $end])
                    ->when($cabang && $cabang !== 'Semua Cabang', function ($q) use ($cabang, $kolomCabang) {
                        $q->where($kolomCabang, $cabang);
                    })
                    ->sum($kolomUang) ?? 0;
            }

            $chartData[] = round($sum / 1000000, 1);
        }

        $daftarCabang = [
            'Semua Cabang',
            'Cabang Sudirman',
            'Cabang Bukit',
            'Cabang Pekanbaru',
            'Cabang Bagansiapiapi',
        ];

        return view('admin.dashboard', compact(
            'transaksiTerbaru',
            'omzet',
            'jumlahTransaksi',
            'laba',
            'chartLabels',
            'chartData',
            'cabang',
            'tanggal',
            'daftarCabang'
        ));
    }

    public function kasir()
    {
        return view('kasir.kasir');
    }
}