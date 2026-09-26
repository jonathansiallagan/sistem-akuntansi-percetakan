<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\DetailJurnal;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    public function index(Request $request)
    {
        $akuns = Akun::orderBy('kode_akun')->get();

        // Parameter filter (Default: awal hingga akhir bulan ini)
        $akun_id = $request->input('akun_id');
        $start_date = $request->input('start_date', date('Y-m-01'));
        $end_date = $request->input('end_date', date('Y-m-t'));

        $jurnals = collect();
        $akunTerpilih = null;
        $saldoAwal = 0;

        if ($akun_id) {
            $akunTerpilih = Akun::find($akun_id);

            // 1. Menghitung Saldo Awal (semua transaksi sebelum start_date)
            $jurnalsSebelumnya = DetailJurnal::where('akun_id', $akun_id)
                ->whereHas('jurnal', function($q) use ($start_date) {
                    $q->where('tanggal', '<', $start_date);
                })->get();

            $debitSebelumnya = $jurnalsSebelumnya->sum('debit');
            $kreditSebelumnya = $jurnalsSebelumnya->sum('kredit');

            // Logika Normal Balance Akuntansi
            if (in_array($akunTerpilih->tipe_akun, ['Harta', 'Beban'])) {
                $saldoAwal = $debitSebelumnya - $kreditSebelumnya;
            } else {
                $saldoAwal = $kreditSebelumnya - $debitSebelumnya;
            }

            // 2. Mengambil mutasi pada rentang tanggal terpilih
            $jurnals = DetailJurnal::where('akun_id', $akun_id)
                ->whereHas('jurnal', function($q) use ($start_date, $end_date) {
                    $q->whereBetween('tanggal', [$start_date, $end_date]);
                })
                ->join('jurnals', 'detail_jurnals.jurnal_id', '=', 'jurnals.id') // Join untuk sorting tanggal
                ->orderBy('jurnals.tanggal', 'asc')
                ->select('detail_jurnals.*') // Ambil kolom detailnya saja
                ->with('jurnal.user') // Eager loading
                ->get();
        }

        return view('admin.buku_besar.index', compact(
            'akuns', 'jurnals', 'akunTerpilih', 'saldoAwal', 'start_date', 'end_date', 'akun_id'
        ));
    }
}