<?php
/* Developer: Olha Rosolovska */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'slug', 'excerpt', 'content', 'image_url', 'published_at'];
    protected $casts = ['published_at' => 'datetime'];
    public function author() { return $this->belongsTo(User::class, 'user_id'); }
    public function scopePublished($q) { return $q->whereNotNull('published_at'); }
}
