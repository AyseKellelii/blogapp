<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\PostModel;

class Category_postController extends Controller
{
    public function index()
    {

        $categories = CategoryModel::orderBy('name')->get();
        return view('user.category_index', compact('categories'));
    }


    public function show($slug)
    {

        $category = CategoryModel::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->with('user')->latest()->get();
        $categories = CategoryModel::orderBy('name')->get();

        return view('user.category_post', compact('category', 'posts', 'categories'));
    }
}
