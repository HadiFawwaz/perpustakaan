<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Digital</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #2563eb, #1e3a8a);
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
        }

        nav a {
            color: white;
            margin-left: 1.5rem;
            font-weight: 500;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .hero {
            text-align: center;
            padding: 6rem 1rem 3rem;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.15rem;
            color: #e0e7ff;
            max-width: 600px;
            margin: 1rem auto 2rem;
        }

        .btn {
            display: inline-block;
            background: white;
            color: #1e3a8a;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #e0e7ff;
            transform: translateY(-3px);
        }

        .books-preview {
            background: white;
            color: #1e293b;
            padding: 3rem 2rem;
            border-radius: 2rem 2rem 0 0;
            box-shadow: 0 -10px 25px rgba(0,0,0,0.1);
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        .book-card {
            background: #f8fafc;
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(30,64,175,0.1);
        }

        .book-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
        }

        .book-card h3 {
            font-size: 1rem;
            font-weight: 600;
            color: #1e40af;
        }

        .book-card p {
            color: #475569;
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }

        footer {
            margin-top: auto;
            padding: 2rem;
            text-align: center;
            font-size: 0.875rem;
            color: #cbd5e1;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <header>
        <h2 class="text-xl font-semibold tracking-wide">📚 Perpustakaan Digital</h2>
        <nav>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Selamat Datang di Perpustakaan Digital</h1>
        <p>Temukan, pinjam, dan baca buku favoritmu secara online dengan sistem perpustakaan modern berbasis web.</p>
        <a href="{{ route('login') }}" class="btn">Mulai Sekarang</a>
    </section>

    <!-- Book Preview -->
    <section class="books-preview">
        <h2 class="text-2xl font-bold text-center mb-8">📖 Koleksi Buku Terbaru</h2>

        <div class="book-grid">
            @forelse($buku as $item)
                <div class="book-card">
                    @if ($item->sampul)
                            <img src="{{ asset('storage/' . $item->sampul) }}"
                                 alt="{{ $item->judul }}" 
                                 class="w-full h-48 object-cover rounded-t-xl">
                        @else
                            <div class="w-full h-48 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-t-xl text-gray-400">
                                📘
                            </div>
                        @endif
                    <h3>{{ $item->judul }}</h3>
                    <p>{{ $item->kategori }}</p>
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada buku yang tersedia.</p>
            @endforelse
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('login') }}" class="btn">Lihat Semua Buku</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        © {{ date('Y') }} Perpustakaan Digital. Semua hak dilindungi.
    </footer>
</body>
</html>
