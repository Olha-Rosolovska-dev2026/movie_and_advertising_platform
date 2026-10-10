<?php
/* Developer: Olha Rosolovska */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreCrudController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('movies')->orderBy('name')->paginate(20);
        return view('admin.genres.index', compact('genres'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'unique:genres'], 'description' => ['nullable', 'string']]);
        Genre::create(['name' => $data['name'], 'slug' => str()->slug($data['name']), 'description' => $data['description'] ?? null]);
        return back()->with('success', 'Genre created.');
    }

    public function update(Request $request, Genre $genre)
    {
        $data = $request->validate(['name' => ['required', 'unique:genres,name,' . $genre->id], 'description' => ['nullable', 'string']]);
        $genre->update(['name' => $data['name'], 'slug' => str()->slug($data['name']), 'description' => $data['description'] ?? null]);
        return back()->with('success', 'Genre updated.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return back()->with('success', 'Genre deleted.');
    }
}
