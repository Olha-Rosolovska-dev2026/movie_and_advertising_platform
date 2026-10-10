@extends('layouts.admin')
@section('title', $post->exists ? 'Edit Post' : 'New Post')
@section('content')
<h1 class="text-3xl font-black mb-6">{{ $post->exists ? 'Edit Post' : 'New Post' }}</h1>
<form method="POST" action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}" class="bg-gray-900 rounded-xl border border-gray-800 p-6 space-y-5 max-w-3xl">
    @csrf
    @if($post->exists) @method('PUT') @endif
    <div><label class="block text-sm text-gray-400 mb-1">Title *</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <div><label class="block text-sm text-gray-400 mb-1">Slug *</label>
        <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <div><label class="block text-sm text-gray-400 mb-1">Excerpt</label>
        <textarea name="excerpt" rows="2" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">{{ old('excerpt', $post->excerpt) }}</textarea></div>
    <div><label class="block text-sm text-gray-400 mb-1">Content *</label>
        <textarea name="content" rows="12" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">{{ old('content', $post->content) }}</textarea></div>
    <div><label class="block text-sm text-gray-400 mb-1">Cover Image URL</label>
        <input type="url" name="image_url" value="{{ old('image_url', $post->image_url) }}" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <label class="flex items-center gap-2 text-sm">
        <input type="checkbox" name="publish_now" value="1" {{ old('publish_now', $post->published_at !== null) ? 'checked' : '' }}> Publish immediately
    </label>
    <div class="flex gap-3">
        <button class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg font-semibold">{{ $post->exists ? 'Update Post' : 'Create Post' }}</button>
        <a href="{{ route('admin.posts.index') }}" class="bg-gray-800 px-6 py-2 rounded-lg">Cancel</a>
    </div>
</form>
@endsection
