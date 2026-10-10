<?php
/* Developer: Olha Rosolovska */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Movie, Genre};
use Illuminate\Http\Request;

class MovieCrudController extends Controller
{
    public function index(Request $request)
    {
        $movies = Movie::with('genres')
            ->when($request->search, fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->latest()->paginate(15)->withQueryString();
        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        $genres = Genre::orderBy('name')->get();
        return view('admin.movies.form', ['movie' => new Movie(), 'genres' => $genres]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $movie = Movie::create($data);
        $movie->genres()->sync($request->input('genres', []));
        return redirect()->route('admin.movies.index')->with('success', 'Movie created successfully.');
    }

    public function edit(Movie $movie)
    {
        $genres = Genre::orderBy('name')->get();
        return view('admin.movies.form', ['movie' => $movie, 'genres' => $genres]);
    }

    public function update(Request $request, Movie $movie)
    {
        $data = $this->validated($request, $movie->id);
        $movie->update($data);
        $movie->genres()->sync($request->input('genres', []));
        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return back()->with('success', 'Movie deleted.');
    }

    private function validated(Request $request, ?int $id = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:movies,slug' . ($id ? ",{$id}" : '')],
            'synopsis' => ['nullable', 'string'],
            'poster_url' => ['nullable', 'url'],
            'backdrop_url' => ['nullable', 'url'],
            'trailer_url' => ['nullable', 'url'],
            'video_url' => ['nullable', 'url'],
            'release_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'duration_minutes' => ['nullable', 'integer', 'min:1'],
            'rating' => ['nullable', 'string', 'max:20'],
            'price' => ['required', 'numeric', 'min:0'],
            'type' => ['required', 'in:movie,series'],
            'status' => ['required', 'in:draft,published'],
            'featured' => ['nullable', 'boolean'],
        ]);
        $data['featured'] = $request->boolean('featured');
        return $data;
    }
}
