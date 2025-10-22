{{-- resources/views/layouts/navigation.blade.php --}}
@php
    $user = Auth::user();
@endphp

<aside class="w-64 bg-gray-900 text-gray-100 flex flex-col min-h-screen">
    {{-- Header / Logo --}}
    <div class="p-4 border-b border-gray-700 flex items-center space-x-2">
        <span class="text-2xl">📚</span>
        <span class="font-semibold text-lg">PerpusApp</span>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 p-4 space-y-2">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
            class="block px-4 py-2.5 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-gray-800 text-yellow-400' : 'hover:bg-gray-800' }}">
            🏠 Dashboard
        </a>
        <a href="{{ route('admin.peminjaman.index') }}"
                class="block px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.peminjaman.*') ? 'bg-gray-800 text-yellow-400' : 'hover:bg-gray-800' }}">
                🧾 Kelola Peminjaman
            </a>

        @if ($user->role === 'siswa')
            <a href="{{ route('buku.index') }}"
                class="block px-4 py-2.5 rounded-lg transition {{ request()->routeIs('buku.*') ? 'bg-gray-800 text-yellow-400' : 'hover:bg-gray-800' }}">
                📖 Daftar Buku
            </a>

        @elseif ($user->role === 'jaga')
            <a href="{{ route('admin.dashboard') }}"
                class="block px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-yellow-400' : 'hover:bg-gray-800' }}">
                📚 Kelola Buku
            </a>

        @endif
    </nav>

    {{-- Footer --}}
    <div class="p-4 border-t border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium">{{ $user->name }}</p>
                <p class="text-xs text-gray-400 capitalize">{{ $user->role }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 px-2 py-1 text-xs rounded-md transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</aside>
