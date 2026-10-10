<?php
/* Developer: Olha Rosolovska */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'slug', 'synopsis', 'poster_url', 'backdrop_url', 'trailer_url', 'video_url',
        'release_year', 'duration_minutes', 'rating', 'price', 'type', 'status', 'featured', 'views',
    ];
    protected $casts = ['featured' => 'boolean', 'price' => 'float'];

    public function genres() { return $this->belongsToMany(Genre::class); }
    public function trailers() { return $this->hasMany(Trailer::class); }
    public function purchases() { return $this->hasMany(Purchase::class); }

    public function scopePublished($q) { return $q->where('status', 'published'); }
}
