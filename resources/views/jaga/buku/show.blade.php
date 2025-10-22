<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg">
        <div class="flex flex-col md:flex-row gap-6">
            <img src="{{ asset('storage/' . $buku->sampul) }}" alt="{{ $buku->judul }}" class="w-48 h-64 object-cover rounded-lg border">

            <div class="flex-1 space-y-3">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $buku->judul }}</h2>
                <p class="text-gray-600 dark:text-gray-300"><strong>Kategori:</strong> {{ $buku->kategori }}</p>
                <p class="text-gray-600 dark:text-gray-300"><strong>Stok:</strong> {{ $buku->stok }}</p>
                <p class="text-gray-600 dark:text-gray-300">
                    <strong>Status:</strong> 
                    <span class="px-2 py-1 rounded-full text-sm {{ $buku->status == 'tersedia' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ ucfirst($buku->status) }}
                    </span>
                </p>
                <p class="text-gray-700 dark:text-gray-300"><strong>Deskripsi:</strong><br>{{ $buku->deskripsi }}</p>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            @if ($buku->status == 'tersedia')
                <a href="{{ route('siswa.pinjam.create', $buku->id) }}" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    📖 Pinjam Buku
                </a>
            @else
                <p class="text-red-500 text-lg font-semibold">❌ Buku sedang tidak tersedia</p>
            @endif
        </div>
    </div>
</x-app-layout>
