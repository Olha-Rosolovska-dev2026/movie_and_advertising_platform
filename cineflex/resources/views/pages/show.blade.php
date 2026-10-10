@extends('layouts.app')
@section('title', $page->title)
@section('content')
<article class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="text-4xl font-black mb-8">{{ $page->title }}</h1>
    <div class="text-gray-300 leading-relaxed space-y-4">
        {!! nl2br(e($page->content)) !!}
    </div>
</article>
@endsection
