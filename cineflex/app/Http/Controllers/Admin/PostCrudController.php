<?php
/* Developer: Olha Rosolovska */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCrudController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.form', ['post' => new Post()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['user_id'] = Auth::id();
        $data['published_at'] = $request->boolean('publish_now') ? now() : null;
        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'Post created.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validated($request, $post->id);
        $data['published_at'] = $request->boolean('publish_now') ? ($post->published_at ?? now()) : null;
        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted.');
    }

    private function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:posts,slug' . ($id ? ",{$id}" : '')],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'image_url' => ['nullable', 'url'],
        ]);
    }
}
