<?php
/* Developer: Olha Rosolovska */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdPlacement extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'location', 'price_per_week', 'active'];
    protected $casts = ['active' => 'boolean', 'price_per_week' => 'float'];
    public function campaigns() { return $this->hasMany(AdCampaign::class); }
}
