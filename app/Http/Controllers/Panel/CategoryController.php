<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\CategoryRequest;
use App\Models\CategoryModel;
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
        if ($request->ajax()) {
            $data = CategoryModel::select(['id', 'name', 'slug', 'created_at']);

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
    }

    public function store(CategoryRequest $request)
    {
        CategoryModel::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json(['success' => 'Kategori başarıyla eklendi!']);
    }

    public function edit(CategoryModel $category)
    {
        return response()->json(['category' => $category]);
    }

    public function update(CategoryRequest $request, CategoryModel $category)
    {
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json(['success' => 'Kategori başarıyla güncellendi!']);
    }

    public function destroy(CategoryModel $category)
    {
        $category->delete();

        return response()->json(['success' => 'Kategori silindi!']);
    }
}
