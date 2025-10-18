<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = CategoryModel::orderBy('name')->get();
        return view('user.contact',compact('categories'));
    }
}
