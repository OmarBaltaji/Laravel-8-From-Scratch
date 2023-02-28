<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show()
    {
        return view('account', ['user' => auth()->user()]);
    }

    public function update()
    {
        $attributes = request()->validate([
            'username' => 'required|string|max:191',
            'avatar' => 'image',
        ]);

        $auth_user = auth()->user();

        if($attributes['avatar'] ?? false) {
            $attributes['avatar'] = request()->file('avatar')->store("avatars/{$auth_user->id}");
        }

        $auth_user->update($attributes);

        return back()->with('success', 'Account information updated successfully');
    }
}
