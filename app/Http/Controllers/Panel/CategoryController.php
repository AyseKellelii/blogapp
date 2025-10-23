<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('panel.category');
    }

    public function fetch(Request $request)
    {
        abort_unless($request->ajax(), 404, 'Geçersiz istek.');

        $data = Category::select(['id', 'name', 'slug', 'created_at'])->latest();

        return DataTables::of($data)
            ->addColumn('actions', function ($row) {
                return '
                <button class="btn btn-sm btn-warning editBtn" data-id="'.$row->id.'">Düzenle</button>
                <button class="btn btn-sm btn-danger deleteBtn" data-id="'.$row->id.'">Sil</button>
            ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        Category::create($data);

        return response()->json(['success' => 'Kategori başarıyla eklendi!']);
    }

    public function edit(Category $category)
    {
        return response()->json(['category' => $category]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        $category->update($data);

        return response()->json(['success' => 'Kategori başarıyla güncellendi!']);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['success' => 'Kategori silindi!']);
    }
}
