<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <div><h1 class="text-3xl font-bold text-gray-800">Jurnal Umum</h1></div>
        <a href="{{ route('jurnal.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium"><i class="fa-solid fa-plus"></i> Tambah Jurnal Manual</a>
    </div>

    @if (session('success')) <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div> @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 font-bold border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Tanggal & Referensi</th>
                    <th class="px-6 py-4">Keterangan</th>
                    <th class="px-6 py-4">Akun</th>
                    <th class="px-6 py-4 text-right">Debit</th>
                    <th class="px-6 py-4 text-right">Kredit</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($jurnals as $jurnal)
                    @foreach ($jurnal->detailJurnals as $index => $detail)
                    <tr class="hover:bg-gray-50 transition {{ $index == 0 ? 'border-t-2 border-gray-200' : '' }}">
                        @if ($index == 0)
                            <td class="px-6 py-3 align-top" rowspan="{{ $jurnal->detailJurnals->count() }}">
                                <div class="font-bold">{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d M Y') }}</div>
                                <div class="text-xs text-blue-600 mt-1">{{ $jurnal->no_referensi }}</div>
                                <div class="text-[10px] text-gray-400 mt-1">{{ $jurnal->cabang->nama ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-3 align-top text-gray-600" rowspan="{{ $jurnal->detailJurnals->count() }}">
                                {{ $jurnal->keterangan }}
                            </td>
                        @endif
                        <td class="px-6 py-3 {{ $detail->kredit > 0 ? 'pl-10 text-gray-600' : 'font-bold text-gray-800' }}">
                            {{ $detail->akun->kode_akun }} - {{ $detail->akun->nama_akun }}
                        </td>
                        <td class="px-6 py-3 text-right">{{ $detail->debit > 0 ? 'Rp '.number_format($detail->debit, 0, ',', '.') : '-' }}</td>
                        <td class="px-6 py-3 text-right">{{ $detail->kredit > 0 ? 'Rp '.number_format($detail->kredit, 0, ',', '.') : '-' }}</td>
                    </tr>
                    @endforeach
                @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada pencatatan jurnal.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>