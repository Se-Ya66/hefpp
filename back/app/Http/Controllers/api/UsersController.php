<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return $users;
    }

    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->all())->save();
        return $user;
    }

    public function follow(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return [
            'follower_count' => $user->count_followers,
        ];
    }
    
    public function unfollow(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return [
            'follower_count' => $user->count_followers,
        ];
    }

    public function isfollowed (Request $request, $id)
    {
        $user = User::find($id);
        $id = $request->user()->id;
        if ($user->followers()->where('follower_id', $id)->exists()) {
            $result = true;
        } else {
            $result = false;
        }
        return [
            'result' => $result,
        ];

    }

    public function count ($id)
    {
        $user = User::find($id);
        return [
            'follow_count' => $user->count_followings,
            'follower_count' => $user->count_followers,
        ];
    }

    public function followings ($id)
    {
        $user = User::find($id);
        return [
            'user' =>$user->followings
        ];
    }

    public function followers ($id)
    {
        $user = User::find($id);
        return [
            'user' =>$user->followers
        ];
    }
}
