<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostsUsersView;

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
            if(auth()->user()) {
                // Check if the auth user already viewed this post
                $view = PostsUsersView::where('user_id', auth()->user()->id)
                                ->where('post_id', $post->id)->get();
                
                if($view->isEmpty()) {
                    PostsUsersView::create([
                        'user_id' => auth()->user()->id,
                        'post_id' => $post->id
                    ]);

                    $post->increment('view_count');
                }
            }

            return view('posts.show', [
                'post' => $post
            ]);
        }

        abort(404);
    }
}
