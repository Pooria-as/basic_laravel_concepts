<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    public function like(Post $post)
    {
        $post->likes()->create([
            'post_id' => $post->id,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }

    public function unLike(Post $post, Request $request)
    {
        $request
            ->user()
            ->likes()
            ->where('post_id', $post->id)
            ->delete();
        return back();
    }
}
