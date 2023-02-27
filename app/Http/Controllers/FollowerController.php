<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        try {
            if(auth()->user()->id !== $user->id) {
                $following = DB::table('followers')->where('follower_id', auth()->user()->id)
                                        ->where('followed_id', $user->id)->first();

                $userName = ucwords($user->name);
                if(!$following) {
                    DB::table('followers')->insert([
                        'follower_id' => auth()->user()->id,
                        'followed_id' => $user->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
            
                    return back()->with('success', "You are now following $userName");
                } else {
                    DB::table('followers')->delete($following->id);
                    return back()->with('success', "You have unfollowed $userName");
                }
            } else {
                return back()->with('error', "You cannot follow yourself");
            }
        } catch(Exception $e) {
            throw $e->getMessage();
        }
    }
}
