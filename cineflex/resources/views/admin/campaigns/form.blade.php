@extends('layouts.admin')
@section('title', $campaign->exists ? 'Edit Campaign' : 'New Campaign')
@section('content')
<h1 class="text-3xl font-black mb-6">{{ $campaign->exists ? 'Edit Campaign' : 'New Campaign' }}</h1>
<form method="POST" action="{{ $campaign->exists ? route('admin.campaigns.update', $campaign) : route('admin.campaigns.store') }}" class="bg-gray-900 rounded-xl border border-gray-800 p-6 grid md:grid-cols-2 gap-5 max-w-3xl">
    @csrf
    @if($campaign->exists) @method('PUT') @endif
    <div>
        <label class="block text-sm text-gray-400 mb-1">Placement *</label>
        <select name="ad_placement_id" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
            @foreach($placements as $p)
                <option value="{{ $p->id }}" {{ old('ad_placement_id', $campaign->ad_placement_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Advertiser *</label>
        <input type="text" name="advertiser" value="{{ old('advertiser', $campaign->advertiser) }}" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm text-gray-400 mb-1">Campaign Title *</label>
        <input type="text" name="title" value="{{ old('title', $campaign->title) }}" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Media URL (banner image)</label>
        <input type="url" name="media_url" value="{{ old('media_url', $campaign->media_url) }}" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Target URL</label>
        <input type="url" name="target_url" value="{{ old('target_url', $campaign->target_url) }}" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Budget (USD) *</label>
        <input type="number" step="0.01" name="budget" value="{{ old('budget', $campaign->budget ?? 0) }}" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Status *</label>
        <select name="status" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
            @foreach(['pending', 'active', 'paused', 'completed'] as $s)
                <option value="{{ $s }}" {{ old('status', $campaign->status) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">Start Date</label>
        <input type="date" name="starts_at" value="{{ old('starts_at', $campaign->starts_at?->format('Y-m-d')) }}" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div>
        <label class="block text-sm text-gray-400 mb-1">End Date</label>
        <input type="date" name="ends_at" value="{{ old('ends_at', $campaign->ends_at?->format('Y-m-d')) }}" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
    </div>
    <div class="md:col-span-2 flex gap-3">
        <button class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg font-semibold">{{ $campaign->exists ? 'Update' : 'Create' }} Campaign</button>
        <a href="{{ route('admin.campaigns.index') }}" class="bg-gray-800 px-6 py-2 rounded-lg">Cancel</a>
    </div>
</form>
@endsection
