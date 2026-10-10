@extends('layouts.admin')
@section('title', 'Movies')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-black">Movies &amp; Series</h1>
    <a href="{{ route('admin.movies.create') }}" class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg font-semibold"><i class="fas fa-plus"></i> Add Movie</a>
</div>
<form class="mb-4" method="GET">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search movies..." class="bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 w-72">
</form>
<div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-black/60 text-gray-400 uppercase text-xs"><tr>
            <th class="px-4 py-3 text-left">Title</th><th class="px-4 py-3 text-left">Type</th>
            <th class="px-4 py-3 text-left">Genres</th><th class="px-4 py-3 text-left">Price</th>
            <th class="px-4 py-3 text-left">Status</th><th class="px-4 py-3 text-left">Featured</th><th class="px-4 py-3"></th>
        </tr></thead>
        <tbody class="divide-y divide-gray-800">
            @forelse($movies as $movie)
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $movie->title }} <span class="text-gray-600">({{ $movie->release_year }})</span></td>
                    <td class="px-4 py-3">{{ ucfirst($movie->type) }}</td>
                    <td class="px-4 py-3 text-gray-400">{{ $movie->genres->pluck('name')->implode(', ') }}</td>
                    <td class="px-4 py-3">${{ number_format($movie->price, 2) }}</td>
                    <td class="px-4 py-3"><span class="{{ $movie->status === 'published' ? 'text-green-400' : 'text-yellow-400' }}">{{ ucfirst($movie->status) }}</span></td>
                    <td class="px-4 py-3">{{ $movie->featured ? '★' : '—' }}</td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.movies.edit', $movie) }}" class="text-blue-400 hover:underline">Edit</a>
                        <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" class="inline" onsubmit="return confirm('Delete this movie?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-6 text-gray-500">No movies yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $movies->links() }}</div>
@endsection
