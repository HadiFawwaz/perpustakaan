<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-2xl shadow-lg">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">📘 Form Peminjaman Buku</h2>

        <form id="pinjamForm" action="{{ route('siswa.pinjam.store') }}" method="POST" class="grid grid-cols-1 gap-5 md:grid-cols-2">
            @csrf
            <input type="hidden" name="buku_id" value="{{ $buku->id }}">

            <!-- Nama Peminjam -->
            <div class="md:col-span-2">
                <label class="block mb-2 text-gray-700 font-medium">Nama Peminjam</label>
                <input type="text" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-gray-50" value="{{ Auth::user()->name }}" readonly>
            </div>

            <!-- Judul Buku -->
            <div class="md:col-span-2">
                <label class="block mb-2 text-gray-700 font-medium">Judul Buku</label>
                <input type="text" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-gray-50" value="{{ $buku->judul }}" readonly>
            </div>

            <!-- Jumlah Buku -->
            <div>
                <label class="block mb-2 text-gray-700 font-medium">Jumlah Buku (stok: {{ $buku->stok }})</label>
                <input type="number" id="jumlah" name="jumlah" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400" min="1" max="{{ $buku->stok }}" required placeholder="Masukkan jumlah">
                <p id="jumlahError" class="text-red-600 text-sm mt-1 hidden">Jumlah melebihi stok!</p>
            </div>

            <!-- Tanggal Pinjam -->
            <div>
                <label class="block mb-2 text-gray-700 font-medium">Tanggal Pinjam</label>
                <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400" required>
            </div>

            <!-- Tanggal Kembali -->
            <div>
                <label class="block mb-2 text-gray-700 font-medium">Tanggal Kembali</label>
                <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400" required>
            </div>

            <!-- Tombol Submit -->
            <div class="md:col-span-2 flex justify-end">
                <button type="submit" id="submitBtn" class="w-full md:w-auto bg-green-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-700 transition duration-200">
                    Ajukan Peminjaman
                </button>
            </div>
        </form>
    </div>

    <script>
        const jumlahInput = document.getElementById('jumlah');
        const jumlahError = document.getElementById('jumlahError');
        const form = document.getElementById('pinjamForm');
        const stok = {{ $buku->stok }};

        // Validasi jumlah buku realtime
        jumlahInput.addEventListener('input', () => {
            if (parseInt(jumlahInput.value) > stok) {
                jumlahError.classList.remove('hidden');
                jumlahInput.classList.add('border-red-500');
            } else {
                jumlahError.classList.add('hidden');
                jumlahInput.classList.remove('border-red-500');
            }
        });

        // Validasi sebelum submit
        form.addEventListener('submit', (e) => {
            const jumlah = parseInt(jumlahInput.value);
            const tanggalPinjam = document.getElementById('tanggal_pinjam').value;
            const tanggalKembali = document.getElementById('tanggal_kembali').value;

            if (jumlah > stok) {
                e.preventDefault();
                alert('Jumlah buku tidak boleh melebihi stok!');
                return;
            }

            if (!tanggalPinjam || !tanggalKembali) {
                e.preventDefault();
                alert('Harap isi tanggal pinjam dan kembali!');
                return;
            }

            if (tanggalKembali < tanggalPinjam) {
                e.preventDefault();
                alert('Tanggal kembali tidak boleh sebelum tanggal pinjam!');
                return;
            }
        });

        // Set min tanggal hari ini
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal_pinjam').setAttribute('min', today);
        document.getElementById('tanggal_kembali').setAttribute('min', today);
    </script>
</x-app-layout>
