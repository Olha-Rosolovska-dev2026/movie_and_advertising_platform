<?php
/* Developer: Olha Rosolovska */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Trailer, Movie};
use Illuminate\Http\Request;

class TrailerCrudController extends Controller
{
    public function index()
    {
        $trailers = Trailer::with('movie')->latest()->paginate(15);
        return view('admin.trailers.index', compact('trailers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'movie_id' => ['required', 'exists:movies,id'],
            'title' => ['required', 'string', 'max:255'],
            'youtube_url' => ['required', 'url'],
            'duration_seconds' => ['nullable', 'integer', 'min:1'],
        ]);
        Trailer::create($data);
        return back()->with('success', 'Trailer added.');
    }

    public function destroy(Trailer $trailer)
    {
        $trailer->delete();
        return back()->with('success', 'Trailer deleted.');
    }
}
