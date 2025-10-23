<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('panel.post', compact('categories'));
    }

    public function fetch()
    {
        $user = auth()->user();

        $data = Post::with(['categories', 'media'])
            ->where('user_id', $user->id)
            ->latest();

        return DataTables::of($data)
            ->addColumn('categories', fn($post) => $post->categories->pluck('name')->join(', '))
            ->addColumn('image', fn($post) => $post->image_url)
            ->addColumn('is_published', fn($post) => $post->is_published)
            ->addColumn('actions', fn($post) => '
                <button class="btn btn-warning btn-sm editBtn" data-id="'.$post->id.'">Düzenle</button>
                <button class="btn btn-danger btn-sm deleteBtn" data-id="'.$post->id.'">Sil</button>
            ')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);

        $post = Post::create($data);
        $post->categories()->attach($request->categories);

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('post_images');
            $post->addMediaFromRequest('image')->toMediaCollection('post_images');
        }

        return response()->json(['success' => 'Yazı başarıyla eklendi!']);
    }

    public function edit(Post $post)
    {
        $post->load('categories');
        return response()->json(['post' => $post]);
    }


    public function update(PostRequest $request, Post $post)
    {
    \Log::debug($request->validated());
        $post->update($request->validated());

        $post->categories()->sync($request->categories);

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('post_images');
            $post->addMediaFromRequest('image')->toMediaCollection('post_images');
        }

        return response()->json(['success' => 'Yazı başarıyla güncellendi!']);
    }


    public function destroy(Post $post)
    {
        $post->clearMediaCollection('post_images');
        $post->categories()->detach();
        $post->delete();

        return response()->json(['success' => 'Yazı başarıyla silindi!']);
    }
}
