<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Buku Besar</h1>
        <p class="text-gray-500 mt-1">Laporan mutasi dan saldo per akun perkiraan.</p>
    </div>

    <!-- FORM FILTER -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
        <form action="{{ route('buku_besar.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="w-full md:w-1/3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Akun</label>
                <select name="akun_id" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500" required>
                    <option value="">-- Pilih Akun --</option>
                    @foreach($akuns as $akun)
                        <option value="{{ $akun->id }}" {{ $akun_id == $akun->id ? 'selected' : '' }}>
                            {{ $akun->kode_akun }} - {{ $akun->nama_akun }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $start_date }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="w-full md:w-1/4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ $end_date }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="w-full md:w-auto">
                <button type="submit" class="w-full bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition flex items-center gap-2 justify-center">
                    <i class="fa-solid fa-filter"></i> Tampilkan
                </button>
            </div>
        </form>
    </div>

    <!-- TABEL LAPORAN -->
    @if($akunTerpilih)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-gray-800 text-lg">Buku Besar: {{ $akunTerpilih->kode_akun }} - {{ $akunTerpilih->nama_akun }}</h3>
                <p class="text-sm text-gray-500 mt-1">Periode: {{ \Carbon\Carbon::parse($start_date)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->format('d M Y') }}</p>
            </div>
            <div class="text-right">
                <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Tipe Akun</span>
                <div class="font-bold text-blue-600">{{ $akunTerpilih->tipe_akun }}</div>
            </div>
        </div>

        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 font-bold border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">No Referensi</th>
                    <th class="px-6 py-4">Keterangan</th>
                    <th class="px-6 py-4 text-right">Debit</th>
                    <th class="px-6 py-4 text-right">Kredit</th>
                    <th class="px-6 py-4 text-right bg-gray-100">Saldo</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <!-- Baris Saldo Awal -->
                <tr class="bg-orange-50/30">
                    <td colspan="3" class="px-6 py-4 font-bold text-gray-700 text-right">Saldo Awal :</td>
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4 text-right font-bold text-gray-800 bg-orange-50">Rp {{ number_format($saldoAwal, 0, ',', '.') }}</td>
                </tr>

                <!-- Baris Mutasi -->
                @php 
                    $saldoBerjalan = $saldoAwal; 
                    $isDebitNormal = in_array($akunTerpilih->tipe_akun, ['Harta', 'Beban']);
                @endphp
                
                @forelse($jurnals as $detail)
                    @php
                        if ($isDebitNormal) {
                            $saldoBerjalan = $saldoBerjalan + $detail->debit - $detail->kredit;
                        } else {
                            $saldoBerjalan = $saldoBerjalan + $detail->kredit - $detail->debit;
                        }
                    @endphp
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($detail->jurnal->tanggal)->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-blue-600 font-medium">{{ $detail->jurnal->no_referensi }}</td>
                        <td class="px-6 py-4">{{ $detail->jurnal->keterangan }}</td>
                        <td class="px-6 py-4 text-right">{{ $detail->debit > 0 ? 'Rp '.number_format($detail->debit, 0, ',', '.') : '-' }}</td>
                        <td class="px-6 py-4 text-right">{{ $detail->kredit > 0 ? 'Rp '.number_format($detail->kredit, 0, ',', '.') : '-' }}</td>
                        <td class="px-6 py-4 text-right font-bold text-gray-800 bg-gray-50">Rp {{ number_format($saldoBerjalan, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-400">Tidak ada mutasi transaksi pada periode ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif
</x-admin-layout>