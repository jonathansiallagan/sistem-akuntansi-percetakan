<!-- ===================================================== -->
<!-- MODAL KONFIRMASI LOGOUT -->
<!-- ===================================================== -->
<div id="logoutModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-[99999] px-4">
    <div class="bg-white w-full max-w-sm rounded-xl shadow-2xl overflow-hidden">
        <div class="pt-5 flex justify-center">
            <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                <i class="fa-solid fa-right-from-bracket text-red-500 text-xl"></i>
            </div>
        </div>
        <div class="px-6 pt-3 pb-4 text-center">
            <h2 class="text-base font-bold text-gray-900">Konfirmasi Keluar</h2>
            <p class="text-[11px] text-gray-500 leading-relaxed mt-2">
                Sesi akun Anda akan diakhiri. Anda harus memasukkan username dan kata sandi kembali untuk mengakses sistem SISTA.
            </p>
            <div class="mt-4 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2.5 flex items-center gap-3 text-left">
                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center flex-shrink-0">
                    <span class="text-[10px] font-bold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-2">
                        <p class="text-[10px] font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <span class="px-1.5 py-0.5 rounded-full bg-blue-100 text-blue-600 text-[7px] font-bold uppercase">{{ Auth::user()->role }}</span>
                    </div>
                    <p class="text-[8px] text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-100 px-5 py-3 flex justify-end gap-2">
            <button type="button" onclick="closeLogoutModal()" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-600 text-[10px] font-medium hover:bg-gray-200 transition">Batal</button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white text-[10px] font-medium hover:bg-red-700 transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-right-from-bracket text-[9px]"></i> Ya, Keluar
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ===================================================== -->
<!-- JAVASCRIPT MODAL -->
<!-- ===================================================== -->
<script>
    function openLogoutModal() {
        const modal = document.getElementById('logoutModal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeLogoutModal() {
        const modal = document.getElementById('logoutModal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    document.getElementById('logoutModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeLogoutModal();
        }
    });
    
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLogoutModal();
        }
    });
</script>