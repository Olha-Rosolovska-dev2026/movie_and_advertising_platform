<!DOCTYPE html>
{{-- Developer: Olha Rosolovska --}}
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - CineFlex Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-950 text-gray-100">
<div class="flex min-h-screen">
    <aside class="w-64 bg-black border-r border-red-900/40 p-5 space-y-1">
        <a href="{{ route('admin.dashboard') }}" class="block text-2xl font-black mb-6">
            <span class="text-red-600"><i class="fas fa-clapperboard"></i> CINE</span><span class="text-white">FLEX</span>
            <span class="block text-xs text-gray-500 font-normal">Admin Control Panel</span>
        </a>
        @php
            $nav = [
                'Dashboard' => ['admin.dashboard', 'fa-gauge'],
                'Movies' => ['admin.movies.index', 'fa-film'],
                'Genres' => ['admin.genres.index', 'fa-tags'],
                'Trailers' => ['admin.trailers.index', 'fa-video'],
                'Ad Placements' => ['admin.placements.index', 'fa-rectangle-ad'],
                'Ad Campaigns' => ['admin.campaigns.index', 'fa-bullhorn'],
                'Blog Posts' => ['admin.posts.index', 'fa-newspaper'],
                'Pages' => ['admin.pages.index', 'fa-file-lines'],
                'Users' => ['admin.users.index', 'fa-users'],
            ];
        @endphp
        @foreach($nav as $label => [$route, $icon])
            <a href="{{ route($route) }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                      {{ request()->routeIs($route) ? 'bg-red-600 text-white' : 'text-gray-400 hover:bg-gray-900 hover:text-white' }}">
                <i class="fas {{ $icon }} w-5"></i> {{ $label }}
            </a>
        @endforeach
        <div class="pt-4 mt-4 border-t border-gray-800">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-400 hover:text-white">
                <i class="fas fa-arrow-left w-5"></i> Back to Site
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="flex items-center gap-3 px-3 py-2 w-full text-sm text-gray-400 hover:text-white">
                    <i class="fas fa-right-from-bracket w-5"></i> Logout
                </button>
            </form>
        </div>
    </aside>
    <div class="flex-1 p-8">
        @if(session('success'))
            <div class="bg-green-900/40 border border-green-600 text-green-200 px-4 py-3 rounded-lg mb-4">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="bg-red-900/40 border border-red-600 text-red-200 px-4 py-3 rounded-lg mb-4">
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>
