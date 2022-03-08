<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    protected $paginate = 10;
    public function index()
    {
        $posts = Post::latest()->paginate($this->paginate);

        return view('posts.index', compact('posts'));
    }
    public function store(PostRequest $request)
    {
        $data = [
            'body' => $request->body,
        ];

        Auth::user()
            ->posts()
            ->create($data);
        Alert::success('Congrats', 'The Post Added SuccessFull');
        return back();
    }



    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
}
