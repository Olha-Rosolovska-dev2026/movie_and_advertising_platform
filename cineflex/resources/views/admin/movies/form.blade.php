@extends('layouts.admin')
@section('title', $movie->exists ? 'Edit Movie' : 'Add Movie')
@section('content')
<h1 class="text-3xl font-black mb-6">{{ $movie->exists ? 'Edit Movie' : 'Add Movie' }}</h1>
<form method="POST" action="{{ $movie->exists ? route('admin.movies.update', $movie) : route('admin.movies.store') }}" class="bg-gray-900 rounded-xl border border-gray-800 p-6 grid md:grid-cols-2 gap-5 max-w-4xl">
    @csrf
    @if($movie->exists) @method('PUT') @endif
    <div>
        <label class="block text-sm text-gray-400 mb-1">Title *</label>
        <input type="text" name="title" value="{{ old('title', $movie->title) }}" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Slug *</label>
        <input type="text" name="slug" value="{{ old('slug', $movie->slug) }}" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm text-gray-400 mb-1">Synopsis</label>
        <textarea name="synopsis" rows="4" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">{{ old('synopsis', $movie->synopsis) }}</textarea>
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Poster URL</label>
        <input type="url" name="poster_url" value="{{ old('poster_url', $movie->poster_url) }}" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Backdrop URL</label>
        <input type="url" name="backdrop_url" value="{{ old('backdrop_url', $movie->backdrop_url) }}" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Trailer URL</label>
        <input type="url" name="trailer_url" value="{{ old('trailer_url', $movie->trailer_url) }}" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Video URL (full stream)</label>
        <input type="url" name="video_url" value="{{ old('video_url', $movie->video_url) }}" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Release Year</label>
        <input type="number" name="release_year" value="{{ old('release_year', $movie->release_year) }}" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Duration (minutes)</label>
        <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $movie->duration_minutes) }}" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Rating</label>
        <input type="text" name="rating" value="{{ old('rating', $movie->rating) }}" placeholder="e.g. 8.4" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Price (USD) *</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $movie->price ?? 0) }}" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Type *</label>
        <select name="type" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
            <option value="movie" {{ old('type', $movie->type) === 'movie' ? 'selected' : '' }}>Movie</option>
            <option value="series" {{ old('type', $movie->type) === 'series' ? 'selected' : '' }}>Series</option>
        </select>
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Status *</label>
        <select name="status" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
            <option value="draft" {{ old('status', $movie->status) === 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ old('status', $movie->status) === 'published' ? 'selected' : '' }}>Published</option>
        </select>
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm text-gray-400 mb-1">Genres</label>
        <div class="flex flex-wrap gap-4">
            @foreach($genres as $g)
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="genres[]" value="{{ $g->id }}" {{ in_array($g->id, old('genres', $movie->genres->pluck('id')->toArray())) ? 'checked' : '' }}> {{ $g->name }}
                </label>
            @endforeach
        </div>
    </div>
    <label class="flex items-center gap-2 text-sm">
        <input type="hidden" name="featured" value="0">
        <input type="checkbox" name="featured" value="1" {{ old('featured', $movie->featured) ? 'checked' : '' }}> Featured on homepage
    </label>
    <div class="md:col-span-2 flex gap-3">
        <button class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg font-semibold">{{ $movie->exists ? 'Update Movie' : 'Create Movie' }}</button>
        <a href="{{ route('admin.movies.index') }}" class="bg-gray-800 px-6 py-2 rounded-lg">Cancel</a>
    </div>
</form>
@endsection
