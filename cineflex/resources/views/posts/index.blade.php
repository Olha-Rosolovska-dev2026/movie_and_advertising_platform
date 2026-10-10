@extends('layouts.app')
@section('title', 'Blog')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-black mb-8">CineFlex Blog</h1>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($posts as $post)
            <a href="{{ route('posts.show', $post->slug) }}" class="card-hover bg-gray-900 rounded-xl overflow-hidden">
                <div class="h-44 bg-gray-800">
                    @if($post->image_url)<img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">@endif
                </div>
                <div class="p-5">
                    <h2 class="font-bold mb-2">{{ $post->title }}</h2>
                    <p class="text-sm text-gray-400 line-clamp-2">{{ $post->excerpt }}</p>
                    <p class="text-xs text-gray-600 mt-3">{{ $post->author->name }} &middot; {{ $post->published_at->format('M d, Y') }}</p>
                </div>
            </a>
        @empty
            <p class="col-span-full text-gray-500">No posts yet.</p>
        @endforelse
    </div>
    <div class="mt-8">{{ $posts->links() }}</div>
</div>
@endsection
