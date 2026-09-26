<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Transaksi Baru</h1>
    </div>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Kiri (Data Pelanggan) -->
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No Invoice</label>
                        <input type="text" name="no_invoice" value="{{ $no_invoice }}" class="w-full px-4 py-2 border rounded-lg bg-gray-50" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full px-4 py-2 border rounded-lg" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" class="w-full px-4 py-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cabang Transaksi</label>
                        <select name="cabang_id" class="w-full px-4 py-2 border rounded-lg" required>
                            @foreach($cabangs as $cabang)
                                <option value="{{ $cabang->id }}" {{ Auth::user()->cabang_id == $cabang->id ? 'selected' : '' }}>{{ $cabang->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="mb-4">
                <h3 class="font-bold text-gray-800 mb-4">Detail Produk</h3>
                
                <div id="item-list">
                    <!-- Baris Item (Akan dibuat dinamis oleh JS) -->
                    <div class="item-row grid grid-cols-12 gap-2 mb-3 items-end">
                        <div class="col-span-4">
                            <label class="block text-xs text-gray-500 mb-1">Produk</label>
                            <select name="produk_id[]" class="w-full px-2 py-2 border rounded-lg produk-select" required onchange="calculateRow(this)">
                                <option value="">- Pilih Produk -</option>
                                @foreach($produks as $produk)
                                    <option value="{{ $produk->id }}" data-harga="{{ $produk->harga_jual }}" data-hpp="{{ $produk->hpp }}" data-satuan="{{ $produk->satuan }}">
                                        {{ $produk->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs text-gray-500 mb-1">P/L (m) *</label>
                            <div class="flex gap-1">
                                <input type="number" step="0.01" name="lebar[]" class="w-full px-2 py-2 border rounded-lg lebar-input" placeholder="L" oninput="calculateRow(this)" disabled>
                                <input type="number" step="0.01" name="tinggi[]" class="w-full px-2 py-2 border rounded-lg tinggi-input" placeholder="P" oninput="calculateRow(this)" disabled>
                                <input type="hidden" name="luas[]" class="luas-input">
                            </div>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs text-gray-500 mb-1">Qty</label>
                            <input type="number" name="jumlah[]" class="w-full px-2 py-2 border rounded-lg jumlah-input" value="1" min="1" required oninput="calculateRow(this)">
                        </div>
                        <div class="col-span-4">
                            <label class="block text-xs text-gray-500 mb-1">Subtotal</label>
                            <input type="text" class="w-full px-2 py-2 border rounded-lg bg-gray-50 font-bold subtotal-display" readonly>
                            <input type="hidden" name="harga_satuan[]" class="harga-satuan-input">
                            <input type="hidden" name="hpp_satuan[]" class="hpp-satuan-input">
                            <input type="hidden" name="subtotal[]" class="subtotal-input">
                            <input type="hidden" name="total_hpp_item[]" class="total-hpp-item-input">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Kanan (Total & Pembayaran) -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-700 text-white">
                <h3 class="font-bold text-gray-300 mb-4">Total Pembayaran</h3>
                <div class="text-4xl font-bold text-green-400 mb-6" id="grand-total-display">Rp 0</div>
                
                <input type="hidden" name="total_transaksi_input" id="total_transaksi_input">
                <input type="hidden" name="total_hpp_input" id="total_hpp_input">

                <button type="submit" class="w-full bg-blue-600 text-white px-6 py-4 rounded-lg font-bold text-lg hover:bg-blue-700 transition">
                    Proses Transaksi
                </button>
                <p class="text-xs text-gray-400 mt-4 text-center">* P/L hanya diisi jika satuan produk adalah meter (m2).</p>
            </div>
        </div>
    </form>

    <script>
        function calculateRow(element) {
            let row = element.closest('.item-row');
            let select = row.querySelector('.produk-select');
            let option = select.options[select.selectedIndex];
            
            if(!option.value) return;

            let harga = parseFloat(option.getAttribute('data-harga')) || 0;
            let hpp = parseFloat(option.getAttribute('data-hpp')) || 0;
            let satuan = option.getAttribute('data-satuan');
            let qty = parseFloat(row.querySelector('.jumlah-input').value) || 0;
            
            let lebarInput = row.querySelector('.lebar-input');
            let tinggiInput = row.querySelector('.tinggi-input');
            let luasInput = row.querySelector('.luas-input');

            let multiplier = qty;

            // Jika produk meteran (m2)
            if(satuan.toLowerCase().includes('m2') || satuan.toLowerCase().includes('meter')) {
                lebarInput.disabled = false;
                tinggiInput.disabled = false;
                let l = parseFloat(lebarInput.value) || 0;
                let t = parseFloat(tinggiInput.value) || 0;
                let luas = l * t;
                luasInput.value = luas;
                multiplier = luas * qty;
            } else {
                lebarInput.disabled = true;
                tinggiInput.disabled = true;
                lebarInput.value = '';
                tinggiInput.value = '';
                luasInput.value = '';
            }

            let subtotal = harga * multiplier;
            let totalHpp = hpp * multiplier;

            row.querySelector('.harga-satuan-input').value = harga;
            row.querySelector('.hpp-satuan-input').value = hpp;
            row.querySelector('.subtotal-input').value = subtotal;
            row.querySelector('.total-hpp-item-input').value = totalHpp;
            row.querySelector('.subtotal-display').value = 'Rp ' + subtotal.toLocaleString('id-ID');

            calculateGrandTotal();
        }

        function calculateGrandTotal() {
            let subtotals = document.querySelectorAll('.subtotal-input');
            let hpps = document.querySelectorAll('.total-hpp-item-input');
            
            let grandTotal = 0;
            let grandHpp = 0;

            subtotals.forEach(item => grandTotal += parseFloat(item.value) || 0);
            hpps.forEach(item => grandHpp += parseFloat(item.value) || 0);

            document.getElementById('total_transaksi_input').value = grandTotal;
            document.getElementById('total_hpp_input').value = grandHpp;
            document.getElementById('grand-total-display').innerText = 'Rp ' + grandTotal.toLocaleString('id-ID');
        }
    </script>
</x-admin-layout>