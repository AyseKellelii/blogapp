<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\PostModel;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $categories = CategoryModel::orderBy('name')->get();
        $posts = PostModel::with('user')
            ->where('is_published', 1)
            ->whereHas('user', function ($query) {
                $query->where('role', 'admin');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.post', compact('categories','posts'));
    }

    public function show($slug)
    {
        $post = PostModel::with('user', 'categories')->where('slug', $slug)->firstOrFail();
        $categories = CategoryModel::orderBy('name')->get();

        return view('user.post_show', compact('post', 'categories'));
    }

}
