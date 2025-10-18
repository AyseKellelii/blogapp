<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PostRequest;
use App\Models\CategoryModel;
use App\Models\PostModel;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function index()
    {
        $categories = CategoryModel::all();
        return view('panel.post', compact('categories'));
    }

    public function fetch()
    {

        $user = auth()->user();
        $data = PostModel::with(['categories', 'media'])
            ->where('user_id', $user->id)
            ->latest();

        return DataTables::of($data)
            ->addColumn('categories', fn($post) => $post->categories->pluck('name')->join(', '))
            ->addColumn('image', fn($post) => $post->image_url)
            ->addColumn('actions', function ($post) {
                return '
                <button class="btn btn-warning btn-sm editBtn" data-id="'.$post->id.'">Düzenle</button>
                <button class="btn btn-danger btn-sm deleteBtn" data-id="'.$post->id.'">Sil</button>
            ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function store(PostRequest $request)
    {
        $post = PostModel::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->body,
            'slug' => Str::slug($request->title),
            'is_published' => $request->has('is_published') ? 1 : 0,
        ]);

        $post->categories()->attach($request->categories);

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection('post_images');
        }

        return response()->json(['success' => 'Yazı başarıyla eklendi!']);
    }

    public function edit($id)
    {
        $post = PostModel::with('categories')->findOrFail($id);
        return response()->json(['post' => $post]);
    }

    public function update(PostRequest $request, $id)
    {
        $post = PostModel::findOrFail($id);

        $post->update([
            'title' => $request->title,
            'content' => $request->body,
            'slug' => Str::slug($request->title),
            'is_published' => $request->has('is_published') ? 1 : 0,
        ]);

        $post->categories()->sync($request->categories);

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('post_images');
            $post->addMediaFromRequest('image')->toMediaCollection('post_images');
        }

        return response()->json(['success' => 'Yazı başarıyla güncellendi!']);
    }

    public function destroy($id)
    {
        $post = PostModel::findOrFail($id);
        $post->clearMediaCollection('post_images');
        $post->categories()->detach();
        $post->delete();

        return response()->json(['success' => 'Yazı başarıyla silindi!']);
    }
}
