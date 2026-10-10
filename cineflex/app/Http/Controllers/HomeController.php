<?php
/* Developer: Olha Rosolovska */
namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Post;
use App\Models\AdCampaign;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Movie::published()->where('featured', true)->latest()->take(5)->get();
        $latest = Movie::published()->latest()->take(12)->get();
        $posts = Post::published()->latest('published_at')->take(4)->get();
        $heroAd = AdCampaign::with('placement')->where('status', 'active')
            ->whereHas('placement', fn ($q) => $q->where('slug', 'homepage-hero'))
            ->inRandomOrder()->first();

        return view('home', compact('featured', 'latest', 'posts', 'heroAd'));
    }
}
