@extends('layouts.admin')
@section('title', 'Genres')
@section('content')
<h1 class="text-3xl font-black mb-6">Genres</h1>
<form method="POST" action="{{ route('admin.genres.store') }}" class="bg-gray-900 rounded-xl border border-gray-800 p-5 flex flex-wrap gap-3 items-end mb-6">
    @csrf
    <div><label class="block text-sm text-gray-400 mb-1">Name *</label>
        <input type="text" name="name" required class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <div class="flex-1"><label class="block text-sm text-gray-400 mb-1">Description</label>
        <input type="text" name="description" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <button class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg font-semibold"><i class="fas fa-plus"></i> Add Genre</button>
</form>
<div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-black/60 text-gray-400 uppercase text-xs"><tr>
            <th class="px-4 py-3 text-left">Name</th><th class="px-4 py-3 text-left">Slug</th>
            <th class="px-4 py-3 text-left">Movies</th><th class="px-4 py-3 text-left">Description</th><th class="px-4 py-3"></th>
        </tr></thead>
        <tbody class="divide-y divide-gray-800">
            @forelse($genres as $genre)
                <tr>
                    <td class="px-4 py-3 font-medium">
                        <form method="POST" action="{{ route('admin.genres.update', $genre) }}" class="flex gap-2 items-center">
                            @csrf @method('PUT')
                            <input type="text" name="name" value="{{ $genre->name }}" class="bg-gray-800 border border-gray-700 rounded px-2 py-1 w-36">
                            <input type="text" name="description" value="{{ $genre->description }}" placeholder="Description" class="bg-gray-800 border border-gray-700 rounded px-2 py-1 flex-1">
                            <button class="text-blue-400 hover:underline">Save</button>
                        </form>
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $genre->slug }}</td>
                    <td class="px-4 py-3">{{ $genre->movies_count }}</td>
                    <td></td>
                    <td class="px-4 py-3 text-right">
                        <form action="{{ route('admin.genres.destroy', $genre) }}" method="POST" onsubmit="return confirm('Delete this genre?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-gray-500">No genres yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $genres->links() }}</div>
@endsection
