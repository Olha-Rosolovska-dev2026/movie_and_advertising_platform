<?php
/* Developer: Olha Rosolovska */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trailer extends Model
{
    protected $fillable = ['movie_id', 'title', 'youtube_url', 'duration_seconds'];
    public function movie() { return $this->belongsTo(Movie::class); }
}
