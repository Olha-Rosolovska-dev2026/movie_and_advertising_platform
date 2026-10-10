@extends('layouts.admin')
@section('title', 'Trailers')
@section('content')
<h1 class="text-3xl font-black mb-6">Trailers</h1>
<form method="POST" action="{{ route('admin.trailers.store') }}" class="bg-gray-900 rounded-xl border border-gray-800 p-5 flex flex-wrap gap-3 items-end mb-6">
    @csrf
    <div><label class="block text-sm text-gray-400 mb-1">Movie *</label>
        <select name="movie_id" required class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
            @foreach(\App\Models\Movie::orderBy('title')->get() as $m)
                <option value="{{ $m->id }}">{{ $m->title }}</option>
            @endforeach
        </select></div>
    <div><label class="block text-sm text-gray-400 mb-1">Title *</label>
        <input type="text" name="title" required class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <div><label class="block text-sm text-gray-400 mb-1">YouTube Embed URL *</label>
        <input type="url" name="youtube_url" required placeholder="https://www.youtube.com/embed/..." class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-80"></div>
    <button class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg font-semibold"><i class="fas fa-plus"></i> Add</button>
</form>
<div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-black/60 text-gray-400 uppercase text-xs"><tr>
            <th class="px-4 py-3 text-left">Title</th><th class="px-4 py-3 text-left">Movie</th>
            <th class="px-4 py-3 text-left">URL</th><th class="px-4 py-3"></th>
        </tr></thead>
        <tbody class="divide-y divide-gray-800">
            @forelse($trailers as $trailer)
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $trailer->title }}</td>
                    <td class="px-4 py-3">{{ $trailer->movie->title ?? '—' }}</td>
                    <td class="px-4 py-3 text-gray-500 truncate max-w-xs">{{ $trailer->youtube_url }}</td>
                    <td class="px-4 py-3 text-right">
                        <form action="{{ route('admin.trailers.destroy', $trailer) }}" method="POST" onsubmit="return confirm('Delete this trailer?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-6 text-gray-500">No trailers yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $trailers->links() }}</div>
@endsection
