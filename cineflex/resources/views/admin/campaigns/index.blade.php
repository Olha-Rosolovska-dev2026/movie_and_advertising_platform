@extends('layouts.admin')
@section('title', 'Ad Campaigns')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-black">Ad Campaigns</h1>
    <a href="{{ route('admin.campaigns.create') }}" class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg font-semibold"><i class="fas fa-plus"></i> New Campaign</a>
</div>
<div class="bg-gray-900 rounded-xl border border-gray-800 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-black/60 text-gray-400 uppercase text-xs"><tr>
            <th class="px-4 py-3 text-left">Title</th><th class="px-4 py-3 text-left">Advertiser</th>
            <th class="px-4 py-3 text-left">Placement</th><th class="px-4 py-3 text-left">Budget</th>
            <th class="px-4 py-3 text-left">Impressions</th><th class="px-4 py-3 text-left">Clicks</th>
            <th class="px-4 py-3 text-left">Status</th><th class="px-4 py-3"></th>
        </tr></thead>
        <tbody class="divide-y divide-gray-800">
            @forelse($campaigns as $campaign)
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $campaign->title }}</td>
                    <td class="px-4 py-3">{{ $campaign->advertiser }}</td>
                    <td class="px-4 py-3">{{ $campaign->placement->name ?? '—' }}</td>
                    <td class="px-4 py-3">${{ number_format($campaign->budget, 2) }}</td>
                    <td class="px-4 py-3">{{ number_format($campaign->impressions) }}</td>
                    <td class="px-4 py-3">{{ number_format($campaign->clicks) }}</td>
                    <td class="px-4 py-3"><span class="{{ ['active' => 'text-green-400', 'pending' => 'text-yellow-400', 'paused' => 'text-gray-400', 'completed' => 'text-blue-400'][$campaign->status] }}">{{ ucfirst($campaign->status) }}</span></td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.campaigns.edit', $campaign) }}" class="text-blue-400 hover:underline">Edit</a>
                        <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST" class="inline" onsubmit="return confirm('Delete this campaign?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="px-4 py-6 text-gray-500">No campaigns yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $campaigns->links() }}</div>
@endsection
