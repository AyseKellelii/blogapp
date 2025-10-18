<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class Category_postController extends Controller
{
    public function index()
    {
        $categories = CategoryModel::orderBy('name')->get();
        return view('user.category_post', compact('categories'));
    }
}
