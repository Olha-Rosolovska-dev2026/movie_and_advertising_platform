<?php
/* Developer: Olha Rosolovska */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Movie, Post, Page, AdCampaign, AdPlacement, User, Purchase, Genre};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'movies' => Movie::count(),
            'published_movies' => Movie::published()->count(),
            'genres' => Genre::count(),
            'posts' => Post::count(),
            'pages' => Page::count(),
            'campaigns' => AdCampaign::count(),
            'active_campaigns' => AdCampaign::where('status', 'active')->count(),
            'placements' => AdPlacement::count(),
            'users' => User::count(),
            'revenue' => Purchase::sum('amount'),
            'impressions' => AdCampaign::sum('impressions'),
            'clicks' => AdCampaign::sum('clicks'),
        ];
        $recentMovies = Movie::latest()->take(5)->get();
        $recentCampaigns = AdCampaign::with('placement')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMovies', 'recentCampaigns'));
    }
}
