<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::with('user')
            ->where('is_published', 1)
            ->whereHas('user', function ($query) {
                $query->where('role', 'admin');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.post', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::with('user', 'categories')->where('slug', $slug)->firstOrFail();

        return view('user.post_show', compact('post'));
    }

}
