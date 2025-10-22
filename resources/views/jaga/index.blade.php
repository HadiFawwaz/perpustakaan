<x-app-layout>
    <div class="space-y-8">

        {{-- Header Buku --}}
        <div class="flex justify-between items-center bg-white dark:bg-gray-800 shadow-md rounded-xl px-6 py-4 border border-gray-200 dark:border-gray-700">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">📚 Daftar Buku</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Lihat, edit, atau tambahkan buku ke perpustakaanmu.</p>
            </div>
            @if(Auth::user()->role === 'jaga')
                <a href="{{ route('buku.create') }}"
                   class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition">
                    + Tambah Buku
                </a>
            @endif
        </div>

        {{-- Search & Filter --}}
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-md rounded-xl p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <form action="{{ route('buku.index') }}" method="GET" class="flex items-center w-full sm:w-auto space-x-2">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari judul atau penulis..." 
                       class="w-full sm:w-64 px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 outline-none transition" />
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow-md transition">
                    Cari
                </button>
            </form>

            <form action="{{ route('buku.index') }}" method="GET" class="flex items-center space-x-2">
                <select name="kategori" 
                        onchange="this.form.submit()" 
                        class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <option value="">Semua Kategori</option>
                    <option value="Fiksi" {{ request('kategori') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                    <option value="Non-Fiksi" {{ request('kategori') == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                    <option value="Pelajaran" {{ request('kategori') == 'Pelajaran' ? 'selected' : '' }}>Pelajaran</option>
                    <option value="Teknologi" {{ request('kategori') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                    <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </form>
        </div>

        {{-- Grid Buku --}}
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($buku as $item)
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow hover:shadow-lg transition-all duration-300">
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

                    <div class="p-4 space-y-2">
                        <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-100 truncate">{{ $item->judul }}</h2>
                        
                        <p class="text-sm text-gray-500 dark:text-gray-400">Stok: <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $item->stok }}</span></p>

                        <div class="flex justify-between items-center pt-3">
                        

                            @if(Auth::user()->role === 'jaga')
                                <div class="flex gap-2">
                                    <a href="{{ route('buku.edit', $item->id) }}" 
                                       class="px-3 py-1.5 bg-yellow-400 hover:bg-yellow-500 text-black text-sm rounded-md shadow transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('buku.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm rounded-md shadow transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10 text-gray-500 dark:text-gray-400">
                    Belum ada buku yang ditambahkan.
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>
