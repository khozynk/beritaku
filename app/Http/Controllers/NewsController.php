<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     */
    public function index(Request $request)
    {
        $query = News::published()
            ->with('category', 'user')
            ->withCount('comments');

        // Filter by category
        if ($request->has('kategori') && $request->kategori) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        // Search
        if ($request->has('cari') && $request->cari) {
            $search = $request->cari;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $news = $query->latest('published_at')->paginate(9);
        $categories = Category::all();

        return view('news.index', compact('news', 'categories'));
    }

    /**
     * Display the specified news.
     */
    public function show(News $news)
    {
        // Only show published news
        if (!$news->is_published) {
            abort(404);
        }

        $news->load('category', 'user', 'comments');

        $relatedNews = News::published()
            ->where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->take(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}
