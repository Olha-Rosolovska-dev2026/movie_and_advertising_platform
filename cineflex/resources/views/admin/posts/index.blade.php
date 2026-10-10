@extends('layouts.admin')
@section('title', 'Blog Posts')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-black">Blog Posts</h1>
    <a href="{{ route('admin.posts.create') }}" class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg font-semibold"><i class="fas fa-plus"></i> New Post</a>
</div>
<div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-black/60 text-gray-400 uppercase text-xs"><tr>
            <th class="px-4 py-3 text-left">Title</th><th class="px-4 py-3 text-left">Author</th>
            <th class="px-4 py-3 text-left">Status</th><th class="px-4 py-3 text-left">Published</th><th class="px-4 py-3"></th>
        </tr></thead>
        <tbody class="divide-y divide-gray-800">
            @forelse($posts as $post)
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $post->title }}</td>
                    <td class="px-4 py-3">{{ $post->author->name }}</td>
                    <td class="px-4 py-3"><span class="{{ $post->published_at ? 'text-green-400' : 'text-yellow-400' }}">{{ $post->published_at ? 'Published' : 'Draft' }}</span></td>
                    <td class="px-4 py-3 text-gray-500">{{ $post->published_at?->format('M d, Y') ?? '—' }}</td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-400 hover:underline">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Delete this post?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-gray-500">No posts yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $posts->links() }}</div>
@endsection
