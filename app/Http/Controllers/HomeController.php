<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;

class HomeController extends Controller
{
    /**
     * Display the homepage with latest news.
     */
    public function index()
    {
        $featuredNews = News::published()
            ->with('category', 'user')
            ->latest('published_at')
            ->first();

        $latestNews = News::published()
            ->with('category', 'user')
            ->latest('published_at')
            ->when($featuredNews, function ($query) use ($featuredNews) {
                return $query->where('id', '!=', $featuredNews->id);
            })
            ->take(6)
            ->get();

        $categories = Category::withCount(['news' => function ($query) {
            $query->where('is_published', true);
        }])->get();

        return view('home', compact('featuredNews', 'latestNews', 'categories'));
    }
}
