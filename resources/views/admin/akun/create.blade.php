<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Tambah Akun Baru</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-2xl">
        <form action="{{ route('akun.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Akun</label>
                    <input type="text" name="kode_akun" value="{{ old('kode_akun') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: 111" required>
                    @error('kode_akun') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Akun</label>
                    <select name="tipe_akun" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="Harta" {{ old('tipe_akun') == 'Harta' ? 'selected' : '' }}>Harta (Asset)</option>
                        <option value="Kewajiban" {{ old('tipe_akun') == 'Kewajiban' ? 'selected' : '' }}>Kewajiban (Liability)</option>
                        <option value="Modal" {{ old('tipe_akun') == 'Modal' ? 'selected' : '' }}>Modal (Equity)</option>
                        <option value="Pendapatan" {{ old('tipe_akun') == 'Pendapatan' ? 'selected' : '' }}>Pendapatan (Revenue)</option>
                        <option value="Beban" {{ old('tipe_akun') == 'Beban' ? 'selected' : '' }}>Beban (Expense)</option>
                    </select>
                    @error('tipe_akun') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Akun</label>
                <input type="text" name="nama_akun" value="{{ old('nama_akun') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Kas di Tangan" required>
                @error('nama_akun') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition">Simpan Akun</button>
                <a href="{{ route('akun.index') }}" class="bg-gray-100 text-gray-600 px-6 py-2 rounded-lg font-medium hover:bg-gray-200 transition">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>