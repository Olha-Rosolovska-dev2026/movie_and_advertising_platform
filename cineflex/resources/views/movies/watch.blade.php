@extends('layouts.app')
@section('title', 'Watch ' . $movie->title)
@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4"><i class="fas fa-play text-red-600"></i> Now Playing — {{ $movie->title }}</h1>
    <div class="bg-black rounded-xl overflow-hidden aspect-video flex items-center justify-center">
        @if($movie->video_url)
            <video controls class="w-full h-full" poster="{{ $movie->backdrop_url ?? $movie->poster_url }}">
                <source src="{{ $movie->video_url }}">
                Your browser does not support HTML5 video.
            </video>
        @else
            <div class="text-center text-gray-500">
                <i class="fas fa-clapperboard text-5xl mb-3"></i>
                <p>Video stream is not configured for this title yet.</p>
                <p class="text-sm">Set the video URL in the admin panel to enable playback.</p>
            </div>
        @endif
    </div>
    <div class="mt-6 flex flex-wrap gap-3">
        @foreach($movie->genres as $genre)
            <span class="text-xs bg-red-900/50 text-red-200 px-3 py-1 rounded-full">{{ $genre->name }}</span>
        @endforeach
    </div>
    <a href="{{ route('movies.show', $movie->slug) }}" class="inline-block mt-6 text-red-400 hover:text-red-300">&larr; Back to movie details</a>
</div>
@endsection
