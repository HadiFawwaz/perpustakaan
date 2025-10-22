<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">✏️ Edit Buku</h2>

        <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Judul Buku</label>
                <input type="text" name="judul" value="{{ $buku->judul }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-lg p-2.5" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
                <input type="text" name="kategori" value="{{ $buku->kategori }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-lg p-2.5" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Stok</label>
                    <input type="number" name="stok" value="{{ $buku->stok }}" min="1" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-lg p-2.5" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select name="status" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-lg p-2.5">
                        <option value="tersedia" {{ $buku->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="rusak" {{ $buku->status == 'rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-lg p-2.5">{{ $buku->deskripsi }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Sampul Buku</label>
                <input type="file" name="sampul" class="w-full text-gray-700 dark:text-gray-300">
                @if ($buku->sampul)
                    <img src="{{ asset('storage/' . $buku->sampul) }}" class="w-24 h-32 object-cover mt-3 rounded-lg border">
                @endif
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-5 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">
                    Update Buku
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
