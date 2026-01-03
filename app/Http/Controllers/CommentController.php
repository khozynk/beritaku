<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, News $news)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|max:1000',
        ]);

        $validated['news_id'] = $news->id;

        Comment::create($validated);

        return redirect()->route('news.show', $news)
            ->with('success', 'Komentar Anda berhasil ditambahkan!');
    }
}
