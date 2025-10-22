<x-app-layout>
    <div class="max-w-6xl mx-auto mt-10 px-4">
        <h1 class="text-4xl font-bold mb-8 text-white">📚 Koleksi Buku</h1>

        @if($buku->isEmpty())
            <p class="text-center text-gray-400 text-lg">Tidak ada buku tersedia 😅</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($buku as $item)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-5 flex flex-col justify-between">
                        <div>
                            <div class="relative">
                        @if ($item->sampul)
                            <img src="{{ asset('storage/' . $item->sampul) }}"
                                 alt="{{ $item->judul }}" 
                                 class="w-full h-48 object-cover rounded-t-xl">
                        @else
                            <div class="w-full h-48 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-t-xl text-gray-400">
                                📘
                            </div>
                        @endif
                    </div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $item->judul }}</h2>
                            <p class="text-gray-600 mb-3">Kategori: <span class="font-medium">{{ $item->kategori }}</span></p>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                {{ $item->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                            <a href="{{ route('siswa.buku.show', $item->id) }}" 
                               class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
                               Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
