@extends('layouts.admin')
@section('title', $page->exists ? 'Edit Page' : 'New Page')
@section('content')
<h1 class="text-3xl font-black mb-6">{{ $page->exists ? 'Edit Page' : 'New Page' }}</h1>
<form method="POST" action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" class="bg-gray-900 rounded-xl border border-gray-800 p-6 space-y-5 max-w-3xl">
    @csrf
    @if($page->exists) @method('PUT') @endif
    <div><label class="block text-sm text-gray-400 mb-1">Title *</label>
        <input type="text" name="title" value="{{ old('title', $page->title) }}" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <div><label class="block text-sm text-gray-400 mb-1">Slug *</label>
        <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <div><label class="block text-sm text-gray-400 mb-1">Content *</label>
        <textarea name="content" rows="14" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">{{ old('content', $page->content) }}</textarea></div>
    <label class="flex items-center gap-2 text-sm">
        <input type="checkbox" name="published" value="1" {{ old('published', $page->published ?? true) ? 'checked' : '' }}> Published
    </label>
    <div class="flex gap-3">
        <button class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg font-semibold">{{ $page->exists ? 'Update Page' : 'Create Page' }}</button>
        <a href="{{ route('admin.pages.index') }}" class="bg-gray-800 px-6 py-2 rounded-lg">Cancel</a>
    </div>
</form>
@endsection
