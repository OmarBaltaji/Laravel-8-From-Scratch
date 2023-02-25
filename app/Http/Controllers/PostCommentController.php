<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(Post $post)
    {
        request()->validate([
            'body' => 'required'
        ]);
 
        $post->comments()->create([
            // if request was injected in the method => Request $request
            // 'user_id' => $request->user()->id(),
            // 'body' => $request->input('body'),
            
            'user_id' => request()->user()->id,
            'body' => request('body'),
        ]);

        return back();
    }
}
