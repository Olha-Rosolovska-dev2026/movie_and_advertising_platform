<?php
/* Developer: Olha Rosolovska */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdPlacement;
use Illuminate\Http\Request;

class PlacementCrudController extends Controller
{
    public function index()
    {
        $placements = AdPlacement::withCount('campaigns')->orderBy('name')->paginate(20);
        return view('admin.placements.index', compact('placements'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'price_per_week' => ['required', 'numeric', 'min:0'],
            'active' => ['nullable', 'boolean'],
        ]);
        $data['slug'] = str()->slug($data['name']);
        $data['active'] = $request->boolean('active', true);
        AdPlacement::create($data);
        return back()->with('success', 'Placement created.');
    }

    public function update(Request $request, AdPlacement $placement)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'price_per_week' => ['required', 'numeric', 'min:0'],
            'active' => ['nullable', 'boolean'],
        ]);
        $data['active'] = $request->boolean('active');
        $placement->update($data);
        return back()->with('success', 'Placement updated.');
    }

    public function destroy(AdPlacement $placement)
    {
        $placement->delete();
        return back()->with('success', 'Placement deleted.');
    }
}
