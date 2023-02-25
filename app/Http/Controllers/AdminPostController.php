<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store() 
    {
        $attributes = array_merge($this->validatePost(), [
            'user_id' => auth()->id(),
            'thumbnail' => request()->file('thumbnail')->store('thumbnails'),
        ]);

        $post = Post::create($attributes);

        return redirect('/posts/' . $post->slug);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);

    }

    public function update(Post $post) 
    {     
        $attributes = $this->validatePost($post);
      
        if($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post Updated');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post Deleted');
    }

    protected function validatePost(Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'body' => 'required',
            'excerpt' => 'required',
            'category_id' => ['required','integer', Rule::exists('categories', 'id')],
            'status' => ['string', Rule::in(config('constants.post.statuses'))],
            'user_id' => $post->exists ? ['required', 'integer', Rule::exists('users', 'id')] : ['integer', Rule::exists('users', 'id')]
        ]);
    }
}
