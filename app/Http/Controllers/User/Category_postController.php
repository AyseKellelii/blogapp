<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\PostModel;
use Illuminate\Http\Request;

class Category_postController extends Controller
{
    public function show($slug)
    {
        // Slug'a göre kategori bul
        $category = CategoryModel::where('slug', $slug)->firstOrFail();

        // Bu kategoriye ait blogları getir
        $posts = $category->posts()->with('user')->latest()->get();

        // Menüde yine tüm kategoriler listelensin
        $categories = CategoryModel::orderBy('name')->get();

        return view('user.category_post', compact('category', 'posts', 'categories'));
    }
}
