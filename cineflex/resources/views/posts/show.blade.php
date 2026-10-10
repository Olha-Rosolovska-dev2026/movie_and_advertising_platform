@extends('layouts.app')
@section('title', $post->title)
@section('content')
<article class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="text-4xl font-black mb-3">{{ $post->title }}</h1>
    <p class="text-gray-500 mb-8">By {{ $post->author->name }} on {{ $post->published_at->format('F d, Y') }}</p>
    @if($post->image_url)
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="rounded-xl mb-8 w-full">
    @endif
    <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed space-y-4">
        {!! nl2br(e($post->content)) !!}
    </div>
    <a href="{{ route('posts.index') }}" class="inline-block mt-10 text-red-400 hover:text-red-300">&larr; Back to Blog</a>
</article>
@endsection
