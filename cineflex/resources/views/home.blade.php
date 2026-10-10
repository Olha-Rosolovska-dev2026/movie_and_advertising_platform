@extends('layouts.app')
@section('title', 'Stream Movies. Run Ads. Get Paid.')
@section('content')
    @if($featured->isNotEmpty())
        <section class="relative h-[70vh]">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('{{ $featured->first()->backdrop_url ?? $featured->first()->poster_url }}')"></div>
            <div class="absolute inset-0 hero-fade"></div>
            <div class="relative max-w-7xl mx-auto px-4 h-full flex flex-col justify-end pb-16">
                <span class="text-red-500 font-bold tracking-widest text-sm uppercase">Featured This Week</span>
                <h1 class="text-5xl md:text-6xl font-black my-3 max-w-2xl">{{ $featured->first()->title }}</h1>
                <p class="text-gray-300 max-w-xl mb-6 line-clamp-3">{{ Str::limit($featured->first()->synopsis, 220) }}</p>
                <div class="flex gap-4">
                    <a href="{{ route('movies.show', $featured->first()->slug) }}" class="bg-red-600 hover:bg-red-700 px-8 py-3 rounded-lg font-bold"><i class="fas fa-play"></i> Watch Now</a>
                    <a href="{{ route('movies.index') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur px-8 py-3 rounded-lg font-bold">Browse Catalog</a>
                </div>
            </div>
        </section>
    @endif

    <div class="max-w-7xl mx-auto px-4 py-12">
        @if($heroAd)
            <a href="{{ route('ads.click', $heroAd) }}" class="block mb-10 rounded-xl overflow-hidden border border-red-900/40">
                <div class="bg-gradient-to-r from-red-900/60 to-gray-900 p-6 flex items-center justify-between">
                    <div>
                        <span class="text-xs uppercase tracking-widest text-red-400">Sponsored &middot; {{ $heroAd->advertiser }}</span>
                        <p class="text-xl font-bold">{{ $heroAd->title }}</p>
                    </div>
                    <span class="bg-red-600 px-4 py-2 rounded-lg font-semibold text-sm">Learn More <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>
        @endif

        <h2 class="text-2xl font-bold mb-6"><i class="fas fa-fire text-red-600"></i> Latest Releases</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @forelse($latest as $movie)
                <a href="{{ route('movies.show', $movie->slug) }}" class="card-hover bg-gray-900 rounded-xl overflow-hidden">
                    <div class="aspect-[2/3] bg-gray-800 relative">
                        @if($movie->poster_url)
                            <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-600"><i class="fas fa-film text-4xl"></i></div>
                        @endif
                        <span class="absolute top-2 right-2 bg-black/80 text-xs px-2 py-1 rounded">★ {{ $movie->rating ?? 'N/A' }}</span>
                    </div>
                    <div class="p-3">
                        <p class="font-semibold text-sm truncate">{{ $movie->title }}</p>
                        <p class="text-xs text-gray-500">{{ $movie->release_year }} &middot; {{ ucfirst($movie->type) }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-full text-gray-500">No movies published yet. Add them from the <a class="text-red-500" href="{{ route('admin.dashboard') }}">admin panel</a>.</p>
            @endforelse
        </div>

        @if($posts->isNotEmpty())
            <h2 class="text-2xl font-bold my-10"><i class="fas fa-newspaper text-red-600"></i> From the Blog</h2>
            <div class="grid md:grid-cols-4 gap-4">
                @foreach($posts as $post)
                    <a href="{{ route('posts.show', $post->slug) }}" class="card-hover bg-gray-900 rounded-xl overflow-hidden">
                        <div class="h-36 bg-gray-800">{{ $post->image_url ? '<img src="'.$post->image_url.'" class="w-full h-full object-cover">' : '' }}</div>
                        <div class="p-4">
                            <p class="font-semibold text-sm">{{ $post->title }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $post->published_at->format('M d, Y') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
