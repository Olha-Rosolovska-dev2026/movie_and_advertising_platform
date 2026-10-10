@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<h1 class="text-3xl font-black mb-6">Dashboard</h1>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    @foreach([
        'Movies' => [$stats['movies'], 'fa-film', 'text-blue-400'],
        'Published' => [$stats['published_movies'], 'fa-circle-check', 'text-green-400'],
        'Blog Posts' => [$stats['posts'], 'fa-newspaper', 'text-yellow-400'],
        'CMS Pages' => [$stats['pages'], 'fa-file-lines', 'text-purple-400'],
        'Ad Placements' => [$stats['placements'], 'fa-rectangle-ad', 'text-pink-400'],
        'Ad Campaigns' => [$stats['campaigns'], 'fa-bullhorn', 'text-orange-400'],
        'Active Campaigns' => [$stats['active_campaigns'], 'fa-bolt', 'text-red-400'],
        'Users' => [$stats['users'], 'fa-users', 'text-cyan-400'],
        'Ad Impressions' => [number_format($stats['impressions']), 'fa-eye', 'text-indigo-400'],
        'Ad Clicks' => [number_format($stats['clicks']), 'fa-hand-pointer', 'text-teal-400'],
        'Genres' => [$stats['genres'], 'fa-tags', 'text-lime-400'],
        'Revenue' => ['$' . number_format($stats['revenue'], 2), 'fa-dollar-sign', 'text-emerald-400'],
    ] as $label => [$value, $icon, $color])
        <div class="bg-gray-900 rounded-xl p-5 border border-gray-800">
            <i class="fas {{ $icon }} {{ $color }} text-xl"></i>
            <p class="text-2xl font-black mt-2">{{ $value }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wide">{{ $label }}</p>
        </div>
    @endforeach
</div>
<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-gray-900 rounded-xl border border-gray-800 p-5">
        <h2 class="font-bold mb-4">Recent Movies</h2>
        <ul class="divide-y divide-gray-800 text-sm">
            @foreach($recentMovies as $m)
                <li class="py-2 flex justify-between"><span>{{ $m->title }}</span><span class="text-gray-500">{{ ucfirst($m->status) }}</span></li>
            @endforeach
        </ul>
    </div>
    <div class="bg-gray-900 rounded-xl border border-gray-800 p-5">
        <h2 class="font-bold mb-4">Recent Campaigns</h2>
        <ul class="divide-y divide-gray-800 text-sm">
            @foreach($recentCampaigns as $c)
                <li class="py-2 flex justify-between"><span>{{ $c->title }}</span><span class="text-gray-500">{{ ucfirst($c->status) }}</span></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
