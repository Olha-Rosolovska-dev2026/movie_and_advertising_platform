<!DOCTYPE html>
{{-- Developer: Olha Rosolovska --}}
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CineFlex') - CineFlex Streaming & Advertising Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background: #0a0a0f; }
        .card-hover { transition: transform .25s ease, box-shadow .25s ease; }
        .card-hover:hover { transform: translateY(-6px) scale(1.02); box-shadow: 0 20px 40px rgba(220,38,38,.35); }
        .hero-fade { background: linear-gradient(to top, #0a0a0f 10%, rgba(10,10,15,.4) 60%, rgba(10,10,15,.8) 100%); }
    </style>
</head>
<body class="text-gray-100 min-h-screen flex flex-col">
    <nav class="sticky top-0 z-50 bg-black/80 backdrop-blur border-b border-red-900/40">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-2xl font-black tracking-tight">
                <span class="text-red-600"><i class="fas fa-film"></i> CINE</span><span class="text-white">FLEX</span>
            </a>
            <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('home') }}" class="hover:text-red-500">Home</a>
                <a href="{{ route('movies.index') }}" class="hover:text-red-500">Movies &amp; Series</a>
                <a href="{{ route('posts.index') }}" class="hover:text-red-500">Blog</a>
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-red-400 hover:text-red-300 font-semibold"><i class="fas fa-gauge"></i> Admin</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="hover:text-red-500">Logout ({{ auth()->user()->name }})</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-red-500">Login</a>
                    <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-1">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 mt-4">
                <div class="bg-green-900/40 border border-green-600 text-green-200 px-4 py-3 rounded-lg">{{ session('success') }}</div>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="border-t border-red-900/40 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-10 grid md:grid-cols-3 gap-8 text-sm text-gray-400">
            <div>
                <p class="text-xl font-black text-white mb-2"><span class="text-red-600">CINE</span>FLEX</p>
                <p>The cinematic movie streaming and advertising marketplace. Watch full movies, series and trailers, or promote your brand across our network.</p>
            </div>
            <div>
                <p class="font-semibold text-white mb-2">Explore</p>
                <ul class="space-y-1">
                    <li><a href="{{ route('movies.index') }}" class="hover:text-red-500">Movies &amp; Series</a></li>
                    <li><a href="{{ route('posts.index') }}" class="hover:text-red-500">Blog</a></li>
                    <li><a href="{{ route('pages.show', 'advertise') }}" class="hover:text-red-500">Advertise With Us</a></li>
                </ul>
            </div>
            <div>
                <p class="font-semibold text-white mb-2">Legal</p>
                <ul class="space-y-1">
                    <li><a href="{{ route('pages.show', 'about') }}" class="hover:text-red-500">About</a></li>
                    <li><a href="{{ route('pages.show', 'terms') }}" class="hover:text-red-500">Terms of Service</a></li>
                    <li><a href="{{ route('pages.show', 'privacy') }}" class="hover:text-red-500">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-900 py-4 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} CineFlex. All rights reserved. &middot; Developer: Olha Rosolovska
        </div>
    </footer>
</body>
</html>
