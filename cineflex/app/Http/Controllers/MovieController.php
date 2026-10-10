<?php
/* Developer: Olha Rosolovska */
namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = Movie::published()
            ->when($request->genre, fn ($q, $g) => $q->whereHas('genres', fn ($q2) => $q2->where('slug', $g)))
            ->when($request->search, fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->when($request->type, fn ($q, $t) => $q->where('type', $t))
            ->latest()->paginate(12)->withQueryString();
        $genres = Genre::orderBy('name')->get();

        return view('movies.index', compact('movies', 'genres'));
    }

    public function show(string $slug)
    {
        $movie = Movie::published()->with(['genres', 'trailers'])->where('slug', $slug)->firstOrFail();
        $movie->increment('views');
        $related = Movie::published()->whereHas('genres', fn ($q) => $q->whereIn('genres.id', $movie->genres->pluck('id')))
            ->where('id', '!=', $movie->id)->take(6)->get();
        $preRollAd = \App\Models\AdCampaign::with('placement')->where('status', 'active')
            ->whereHas('placement', fn ($q) => $q->where('slug', 'pre-roll'))
            ->inRandomOrder()->first();

        return view('movies.show', compact('movie', 'related', 'preRollAd'));
    }

    public function watch(string $slug)
    {
        $movie = Movie::published()->with('genres')->where('slug', $slug)->firstOrFail();
        return view('movies.watch', compact('movie'));
    }
}
