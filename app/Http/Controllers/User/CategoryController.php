<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function index($slug)
    {

        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->with('user')->latest()->get();

        return view('user.category_post', compact('category', 'posts'));
    }


}
