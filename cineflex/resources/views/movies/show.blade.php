@extends('layouts.app')
@section('title', $movie->title)
@section('content')
<div class="relative">
    <div class="absolute inset-0 h-[60vh] bg-cover bg-center" style="background-image:url('{{ $movie->backdrop_url ?? $movie->poster_url }}')"></div>
    <div class="absolute inset-0 h-[60vh] hero-fade"></div>
    <div class="relative max-w-7xl mx-auto px-4 pt-40 pb-10 flex flex-col md:flex-row gap-8">
        <div class="w-48 md:w-64 shrink-0 rounded-xl overflow-hidden shadow-2xl">
            @if($movie->poster_url)
                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-full">
            @else
                <div class="aspect-[2/3] bg-gray-800 flex items-center justify-center"><i class="fas fa-film text-5xl text-gray-600"></i></div>
            @endif
        </div>
        <div class="flex-1">
            <h1 class="text-4xl font-black mb-3">{{ $movie->title }}</h1>
            <div class="flex flex-wrap gap-3 text-sm mb-4 text-gray-300">
                <span class="bg-white/10 px-3 py-1 rounded-full">★ {{ $movie->rating ?? 'N/A' }}</span>
                <span class="bg-white/10 px-3 py-1 rounded-full">{{ $movie->release_year }}</span>
                <span class="bg-white/10 px-3 py-1 rounded-full">{{ $movie->duration_minutes }} min</span>
                <span class="bg-white/10 px-3 py-1 rounded-full">{{ ucfirst($movie->type) }}</span>
                <span class="bg-white/10 px-3 py-1 rounded-full">{{ number_format($movie->views) }} views</span>
            </div>
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach($movie->genres as $genre)
                    <a href="{{ route('movies.index', ['genre' => $genre->slug]) }}" class="text-xs bg-red-900/50 text-red-200 px-3 py-1 rounded-full">{{ $genre->name }}</a>
                @endforeach
            </div>
            <p class="text-gray-300 max-w-2xl mb-6">{{ $movie->synopsis }}</p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('movies.watch', $movie->slug) }}" class="bg-red-600 hover:bg-red-700 px-8 py-3 rounded-lg font-bold text-lg">
                    <i class="fas fa-play"></i>
                    {{ $movie->price > 0 ? 'Rent / Buy — $' . number_format($movie->price, 2) : 'Watch Free' }}
                </a>
                @if($movie->trailer_url)
                    <a href="{{ $movie->trailer_url }}" target="_blank" class="bg-white/10 hover:bg-white/20 px-8 py-3 rounded-lg font-bold"><i class="fas fa-video"></i> Trailer</a>
                @endif
            </div>
        </div>
    </div>
</div>

@if($preRollAd)
    <div class="max-w-7xl mx-auto px-4">
        <a href="{{ route('ads.click', $preRollAd) }}" class="block rounded-xl overflow-hidden border border-red-900/40 mb-8">
            <div class="bg-gradient-to-r from-gray-900 to-red-900/60 p-5 flex items-center justify-between">
                <div>
                    <span class="text-xs uppercase tracking-widest text-red-400">Advertisement &middot; {{ $preRollAd->advertiser }}</span>
                    <p class="text-lg font-bold">{{ $preRollAd->title }}</p>
                </div>
                <span class="bg-red-600 px-4 py-2 rounded-lg font-semibold text-sm">Visit Sponsor</span>
            </div>
        </a>
    </div>
@endif

@if($movie->trailers->isNotEmpty())
    <div class="max-w-7xl mx-auto px-4 pb-10">
        <h2 class="text-2xl font-bold mb-4">Trailers &amp; Clips</h2>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach($movie->trailers as $trailer)
                <div class="bg-gray-900 rounded-xl overflow-hidden">
                    <div class="aspect-video">
                        <iframe src="{{ $trailer->youtube_url }}" class="w-full h-full" title="{{ $trailer->title }}" allowfullscreen></iframe>
                    </div>
                    <p class="p-3 text-sm font-semibold">{{ $trailer->title }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endif

@if($related->isNotEmpty())
    <div class="max-w-7xl mx-auto px-4 pb-16">
        <h2 class="text-2xl font-bold mb-4">More Like This</h2>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            @foreach($related as $r)
                <a href="{{ route('movies.show', $r->slug) }}" class="card-hover bg-gray-900 rounded-xl overflow-hidden">
                    <div class="aspect-[2/3] bg-gray-800">
                        @if($r->poster_url)<img src="{{ $r->poster_url }}" alt="{{ $r->title }}" class="w-full h-full object-cover">@endif
                    </div>
                    <p class="p-2 text-xs font-semibold truncate">{{ $r->title }}</p>
                </a>
            @endforeach
        </div>
    </div>
@endif
@endsection
