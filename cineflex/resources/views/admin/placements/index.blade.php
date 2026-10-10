@extends('layouts.admin')
@section('title', 'Ad Placements')
@section('content')
<h1 class="text-3xl font-black mb-6">Ad Placements</h1>
<form method="POST" action="{{ route('admin.placements.store') }}" class="bg-gray-900 rounded-xl border border-gray-800 p-5 flex flex-wrap gap-3 items-end mb-6">
    @csrf
    <div><label class="block text-sm text-gray-400 mb-1">Name *</label>
        <input type="text" name="name" required class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <div><label class="block text-sm text-gray-400 mb-1">Location (e.g. homepage-hero, pre-roll, sidebar) *</label>
        <input type="text" name="location" required class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2"></div>
    <div><label class="block text-sm text-gray-400 mb-1">Price / Week *</label>
        <input type="number" step="0.01" name="price_per_week" required class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 w-28"></div>
    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="active" value="1" checked> Active</label>
    <button class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg font-semibold"><i class="fas fa-plus"></i> Add Placement</button>
</form>
<div class="bg-gray-900 rounded-xl border border-gray-800 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-black/60 text-gray-400 uppercase text-xs"><tr>
            <th class="px-4 py-3 text-left">Name</th><th class="px-4 py-3 text-left">Slug</th>
            <th class="px-4 py-3 text-left">Location</th><th class="px-4 py-3 text-left">Price/Week</th>
            <th class="px-4 py-3 text-left">Campaigns</th><th class="px-4 py-3 text-left">Active</th>
            <th class="px-4 py-3 text-left">Save</th><th class="px-4 py-3"></th>
        </tr></thead>
        <tbody class="divide-y divide-gray-800">
            @forelse($placements as $placement)
                <tr>
                    <td class="px-4 py-3" colspan="7">
                        <form method="POST" action="{{ route('admin.placements.update', $placement) }}" class="flex flex-wrap gap-2 items-center">
                            @csrf @method('PUT')
                            <input type="text" name="name" value="{{ $placement->name }}" class="bg-gray-800 border border-gray-700 rounded px-2 py-1 w-44">
                            <input type="text" name="location" value="{{ $placement->location }}" class="bg-gray-800 border border-gray-700 rounded px-2 py-1 w-44">
                            <input type="number" step="0.01" name="price_per_week" value="{{ $placement->price_per_week }}" class="bg-gray-800 border border-gray-700 rounded px-2 py-1 w-24">
                            <input type="checkbox" name="active" value="1" {{ $placement->active ? 'checked' : '' }}>
                            <button class="text-blue-400 hover:underline">Save</button>
                        </form>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <form action="{{ route('admin.placements.destroy', $placement) }}" method="POST" onsubmit="return confirm('Delete this placement?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                <tr class="text-gray-500 text-xs">
                    <td class="px-4 py-1" colspan="8">slug: {{ $placement->slug }} &middot; {{ $placement->description }}</td>
                </tr>
            @empty
                <tr><td colspan="8" class="px-4 py-6 text-gray-500">No placements yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $placements->links() }}</div>
@endsection
