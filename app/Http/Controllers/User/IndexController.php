<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {

        $publishedPosts = Post::where('is_published', 1)->get();
        $randomPosts = $publishedPosts->shuffle()->take(4);

        $authors = User::where('role', 'admin')->get();


        return view('user.index', compact('randomPosts', 'authors'));
    }
}
