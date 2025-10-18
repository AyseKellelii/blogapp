<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\PostModel;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {

        $publishedPosts = PostModel::where('is_published', 1)->get();
        $randomPosts = $publishedPosts->shuffle()->take(4);

        $authors = User::whereHas('posts', function($q){
            $q->where('is_published', 1);
        })->get();

        $categories = CategoryModel::orderBy('name')->get();

        return view('user.index', compact('randomPosts', 'authors', 'categories'));
    }
}
