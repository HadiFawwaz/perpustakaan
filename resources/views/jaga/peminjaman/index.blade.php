<x-app-layout>
    <div class="max-w-6xl mx-auto mt-10 px-4">
        <h1 class="text-3xl font-bold mb-6 text-white">📋 Daftar Peminjaman Buku</h1>

        <!-- Filter -->
        <form method="GET" class="mb-6 flex flex-col md:flex-row md:items-end gap-4">
            <div>
                <label class="block text-white font-medium mb-1">Status</label>
                <select name="status" class="border border-white rounded-lg p-2">
                    <option value="">Semua</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>

            <div>
                <label class="block text-white font-medium mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="border border-gray-300 rounded-lg p-2">
            </div>

            <div>
                <label class="block text-white font-medium mb-1">Tanggal Selesai</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="border border-gray-300 rounded-lg p-2">
            </div>

            <div>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Filter
                </button>
            </div>
        </form>

        <!-- Tabel History -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-50">
                    <tr class="text-center text-gray-700">
                        <th class="p-3 border-b">#</th>
                        <th class="p-3 border-b">Nama Peminjam</th>
                        <th class="p-3 border-b">Judul Buku</th>
                        <th class="p-3 border-b">Jumlah</th>
                        <th class="p-3 border-b">Tanggal Pinjam</th>
                        <th class="p-3 border-b">Tanggal Kembali</th>
                        <th class="p-3 border-b">Status</th>
                        <th class="p-3 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjaman as $item)
                        <tr class="text-center hover:bg-gray-50 transition">
                            <td class="p-3 border-b">{{ $loop->iteration }}</td>
                            <td class="p-3 border-b">{{ $item->user->name }}</td>
                            <td class="p-3 border-b">{{ $item->buku->judul }}</td>
                            <td class="p-3 border-b">{{ $item->jumlah }}</td>
                            <td class="p-3 border-b">{{ $item->tanggal_pinjam }}</td>
                            <td class="p-3 border-b">{{ $item->tanggal_kembali }}</td>
                            <td class="p-3 border-b">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if ($item->status == 'diproses') bg-yellow-100 text-yellow-800
                                    @elseif ($item->status == 'dipinjam') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="p-3 border-b">
                                <form action="{{ route('admin.peminjaman.status', $item->id) }}" method="POST" class="flex justify-center items-center gap-2">
                                    @csrf
                                    <select name="status" class="border border-gray-300 rounded-lg p-1 text-sm"
                                        {{ Auth::user()->role === 'siswa' ? 'disabled' : '' }}>
                                        <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="dipinjam" {{ $item->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                        <option value="dikembalikan" {{ $item->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                    </select>
                                    <button type="submit"
                                        class="bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700 transition text-sm
                                        {{ Auth::user()->role === 'siswa' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ Auth::user()->role === 'siswa' ? 'disabled' : '' }}>
                                        Update
                                    </button>
                                    <a href="{{ route('admin.peminjaman.show', $item->id) }}" 
                               class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
                               Detail
                            </a>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-4 text-center text-gray-400">Belum ada peminjaman buku 😅</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
