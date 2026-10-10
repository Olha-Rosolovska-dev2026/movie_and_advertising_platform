<?php
/* Developer: Olha Rosolovska */
namespace App\Http\Controllers;

use App\Models\AdCampaign;

class AdClickController extends Controller
{
    public function click(AdCampaign $campaign)
    {
        $campaign->increment('clicks');
        if ($campaign->target_url) {
            return redirect()->away($campaign->target_url);
        }
        return redirect()->route('home');
    }
}
