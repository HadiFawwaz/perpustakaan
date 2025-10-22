<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">📖 Detail Peminjaman Buku</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Info Peminjam -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <h2 class="font-semibold text-gray-700 mb-3">Informasi Peminjam</h2>
                <p><span class="font-medium">Nama:</span> {{ $peminjaman->user->name }}</p>
                <p><span class="font-medium">Email:</span> {{ $peminjaman->user->email }}</p>
                
                <p class="mt-2"><span class="font-medium">Status Peminjaman:</span></p>
                @if(Auth::user()->role !== 'siswa')
                    <form action="{{ route('admin.peminjaman.status', $peminjaman->id) }}" method="POST" class="mt-2 flex gap-2 items-center">
                        @csrf
                        <select name="status" class="border border-gray-300 rounded-lg p-1 text-sm">
                            <option value="diproses" {{ $peminjaman->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="dipinjam" {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="dikembalikan" {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        </select>
                        <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700 transition text-sm">
                            Update
                        </button>
                    </form>
                @else
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                        @if ($peminjaman->status == 'diproses') bg-yellow-100 text-yellow-800
                        @elseif ($peminjaman->status == 'dipinjam') bg-blue-100 text-blue-800
                        @else bg-green-100 text-green-800 @endif">
                        {{ ucfirst($peminjaman->status) }}
                    </span>
                @endif
            </div>

            <!-- Info Buku -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <h2 class="font-semibold text-gray-700 mb-3">Informasi Buku</h2>
                <p><span class="font-medium">Judul Buku:</span> {{ $peminjaman->buku->judul }}</p>
                <p><span class="font-medium">Kategori:</span> {{ $peminjaman->buku->kategori }}</p>
                <p><span class="font-medium">Jumlah Dipinjam:</span> {{ $peminjaman->jumlah }}</p>
                <p><span class="font-medium">Tanggal Pinjam:</span> {{ $peminjaman->tanggal_pinjam }}</p>
                <p><span class="font-medium">Tanggal Kembali:</span> {{ $peminjaman->tanggal_kembali }}</p>
            </div>
        </div>

        <!-- Gambar Buku -->
        <div class="mt-6">
            <h2 class="font-semibold text-gray-700 mb-3">Gambar Buku</h2>
             @if ($peminjaman->buku->sampul)
    <img src="{{ asset('storage/' . $peminjaman->buku->sampul) }}"
         alt="{{ $peminjaman->buku->judul }}" 
         class="w-full h-48 object-cover rounded-t-xl">
@else
    <div class="w-full h-48 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-t-xl text-gray-400">
        📘
    </div>
@endif

        </div>

        <!-- Kembali Button -->
        <div class="mt-6">
            <a href="{{ route('admin.peminjaman.index') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>
