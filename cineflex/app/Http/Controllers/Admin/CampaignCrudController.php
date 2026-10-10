<?php
/* Developer: Olha Rosolovska */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{AdCampaign, AdPlacement};
use Illuminate\Http\Request;

class CampaignCrudController extends Controller
{
    public function index()
    {
        $campaigns = AdCampaign::with('placement')->latest()->paginate(15);
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        $placements = AdPlacement::orderBy('name')->get();
        return view('admin.campaigns.form', ['campaign' => new AdCampaign(), 'placements' => $placements]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        AdCampaign::create($data);
        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign created.');
    }

    public function edit(AdCampaign $campaign)
    {
        $placements = AdPlacement::orderBy('name')->get();
        return view('admin.campaigns.form', ['campaign' => $campaign, 'placements' => $placements]);
    }

    public function update(Request $request, AdCampaign $campaign)
    {
        $campaign->update($this->validated($request));
        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign updated.');
    }

    public function destroy(AdCampaign $campaign)
    {
        $campaign->delete();
        return back()->with('success', 'Campaign deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'ad_placement_id' => ['required', 'exists:ad_placements,id'],
            'title' => ['required', 'string', 'max:255'],
            'advertiser' => ['required', 'string', 'max:255'],
            'media_url' => ['nullable', 'url'],
            'target_url' => ['nullable', 'url'],
            'budget' => ['required', 'numeric', 'min:0'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'status' => ['required', 'in:pending,active,paused,completed'],
            'impressions' => ['nullable', 'integer', 'min:0'],
            'clicks' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
