<?php
/* Developer: Olha Rosolovska */
namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()->with('author')->latest('published_at')->paginate(9);
        return view('posts.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::published()->with('author')->where('slug', $slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }
}
