<?php
/* Developer: Olha Rosolovska */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['user_id', 'movie_id', 'amount'];
    public function user() { return $this->belongsTo(User::class); }
    public function movie() { return $this->belongsTo(Movie::class); }
}
