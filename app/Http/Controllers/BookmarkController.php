<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
    public function store(Post $post) 
    {
        $auth_id = auth()->user()->id;
        if($post->author->id !== $auth_id) {
            $bookmark = DB::table('bookmarks')->where('post_id', $post->id)
                                ->where('user_id', $auth_id)
                                ->first();

            if(!$bookmark) {
                DB::table('bookmarks')->insert([
                    'post_id' => $post->id,
                    'user_id' => $auth_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
    
                return back()->with('success', "You have have added {$post->title} to bookmarks");
            } else {
                DB::table('bookmarks')->delete($bookmark->id);
                return back()->with('success', "You have removed {$post->title} from bookmarks");
            }
        } else {
            return back()->with('error', 'You cannot bookmark posts created by you');
        }
    }
}
