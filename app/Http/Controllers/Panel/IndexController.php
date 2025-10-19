<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
         //sadece giriş yapanın yaılarını getiriyor
        $userPosts = PostModel::where('user_id', $user->id)->get();

        // yayılanmış, taslak sayıları
        $totalPosts = $userPosts->count();
        $publishedPosts = $userPosts->where('is_published', true)->count();
        $unpublishedPosts = $userPosts->where('is_published', false)->count();
        $totalCategories = CategoryModel::count();

        // Aylara göre adminin yayınladığı post sayısı
        $monthlyPosts = PostModel::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('user_id', $user->id)
            ->where('is_published', true)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Grafik verileri
        $months = [];
        $postCounts = [];
        foreach (range(1, 12) as $m) {
            $months[] = Carbon::create()->month($m)->format('M');
            $postCounts[] = $monthlyPosts[$m] ?? 0;
        }

        return view('panel.index', compact(
            'user',
            'totalPosts',
            'publishedPosts',
            'unpublishedPosts',
            'totalCategories',
            'months',
            'postCounts'
        ));
    }
}
