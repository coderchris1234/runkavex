<?php

namespace App\Http\Controllers;

use App\Models\Article;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index', [
            'pageTitle' => 'Runkavex Capital | News',
            'articles' => Article::where('is_published', true)->orderByDesc('published_at')->get(),
        ]);
    }

    public function show(Article $article)
    {
        abort_unless($article->is_published, 404);

        $related = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('news.show', [
            'pageTitle' => $article->title . ' | Runkavex Capital',
            'article' => $article,
            'related' => $related,
        ]);
    }
}