<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() 
    {
        return view('posts.index', [
            'posts' => Post::latest('created_at')
                        ->where('status', 'published')
                        ->with('category', 'author')
                        ->filter(request(['search', 'category', 'author']))
                        ->paginate(6)->withQueryString(), 
        ]);
    }

    public function show(Post $post)
    {
        if($post->status === 'published' || request()->user()->can('admin')) {
            return view('posts.show', [
                'post' => $post
            ]);
        }

        abort(404);
    }
}
