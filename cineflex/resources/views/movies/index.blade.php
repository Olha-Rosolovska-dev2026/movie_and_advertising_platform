@extends('layouts.app')
@section('title', 'Movies & Series')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-black mb-2">Movies &amp; Series</h1>
    <p class="text-gray-400 mb-8">Explore the full CineFlex catalog — cinematic films, series and trailers.</p>

    <form class="flex flex-wrap gap-3 mb-8" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search titles..."
               class="bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 flex-1 min-w-[200px]">
        <select name="genre" class="bg-gray-900 border border-gray-700 rounded-lg px-4 py-2">
            <option value="">All Genres</option>
            @foreach($genres as $g)
                <option value="{{ $g->slug }}" {{ request('genre') === $g->slug ? 'selected' : '' }}>{{ $g->name }}</option>
            @endforeach
        </select>
        <select name="type" class="bg-gray-900 border border-gray-700 rounded-lg px-4 py-2">
            <option value="">All Types</option>
            <option value="movie" {{ request('type') === 'movie' ? 'selected' : '' }}>Movie</option>
            <option value="series" {{ request('type') === 'series' ? 'selected' : '' }}>Series</option>
        </select>
        <button class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg font-semibold"><i class="fas fa-search"></i></button>
    </form>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @forelse($movies as $movie)
            <a href="{{ route('movies.show', $movie->slug) }}" class="card-hover bg-gray-900 rounded-xl overflow-hidden">
                <div class="aspect-[2/3] bg-gray-800">
                    @if($movie->poster_url)
                        <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-600"><i class="fas fa-film text-4xl"></i></div>
                    @endif
                </div>
                <div class="p-3">
                    <p class="font-semibold text-sm truncate">{{ $movie->title }}</p>
                    <p class="text-xs text-gray-500">{{ $movie->release_year }} &middot; {{ ucfirst($movie->type) }} &middot; ${{ number_format($movie->price, 2) }}</p>
                </div>
            </a>
        @empty
            <p class="col-span-full text-gray-500">No results found.</p>
        @endforelse
    </div>

    <div class="mt-8">{{ $movies->links() }}</div>
</div>
@endsection
