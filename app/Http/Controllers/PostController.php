<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index() 
    {
        //  \Illuminate\Support\Facades\DB::listen(function ($query) {
        //     logger($query->sql, $query->bindings);
        // });\

        // dd(Gate::check('admin'), request()->user()->can('admin')
        //, request()->user()->cannot('admin'));
        // $this->authorize('admin');

        return view('posts.index', [
            'posts' => Post::latest('created_at')
                        ->with('category', 'author')
                        ->filter(request(['search', 'category', 'author']))
                        ->paginate(6)->withQueryString(), 
                        // ->simplePaginate(6), 
                        // ->get()
                        //or request()->only('search')
        ]);
    }

    public function show(Post $post)  // Post::find($post) ----> $post here is the id, unless we change getRouteKeyName method in the model, then instead id the value will be something else
    {
        return view('posts.show', [
            // 'post' => Post::findOrFail($id)
            'post' => $post
        ]);
    }

    // index, show, create, store, edit, update, destroy
}
