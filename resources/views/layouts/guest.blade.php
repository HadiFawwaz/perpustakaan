<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Perpustakaan Digital') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .logo {
            text-align: center;
            margin-bottom: 1rem;
            font-weight: 700;
            color: white;
            letter-spacing: 0.05em;
        }

        .footer {
            margin-top: 2rem;
            text-align: center;
            color: #cbd5e1;
            font-size: 0.875rem;
        }
    </style>
</head>

<body class="antialiased">
    <div class="w-full max-w-md mx-auto p-6">
        <!-- Logo / Title -->
        <div class="logo text-2xl">
            📚 {{ config('app.name', 'Perpustakaan Digital') }}
        </div>

        <!-- Card -->
        <div class="glass-card w-full mt-6 px-6 py-8">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <div class="footer">
            © {{ date('Y') }} {{ config('app.name', 'Perpustakaan Digital') }} <br>
            <span class="text-sm opacity-80">Sistem Manajemen Buku Digital</span>
        </div>
    </div>
</body>
</html>
