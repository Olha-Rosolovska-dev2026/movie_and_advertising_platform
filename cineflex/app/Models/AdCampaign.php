<?php
/* Developer: Olha Rosolovska */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdCampaign extends Model
{
    protected $fillable = [
        'ad_placement_id', 'title', 'advertiser', 'media_url', 'target_url',
        'budget', 'starts_at', 'ends_at', 'status', 'impressions', 'clicks',
    ];
    public function placement() { return $this->belongsTo(AdPlacement::class, 'ad_placement_id'); }
}
