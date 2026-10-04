<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    use LogsAdminActivity;

    public function index()
    {
        return view('admin.articles', [
            'pageTitle' => 'Articles | Admin Panel',
            'articles' => Article::orderByDesc('published_at')->paginate(20),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $article = Article::create([
            'title' => $data['title'],
            'slug' => $this->uniqueSlug($data['slug'] ?? null, $data['title']),
            'excerpt' => $data['excerpt'] ?? null,
            'body' => $data['body'],
            'image' => $data['image'] ?? null,
            'author' => $data['author'] ?? null,
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->boolean('is_published') ? now() : null,
        ]);

        $this->logActivity('article.create', 'Article', $article->id, 'Created article ' . $article->title);

        return back()->with('success', 'Article created.');
    }

    public function update(Request $request, $articleId)
    {
        $article = Article::findOrFail((int) $articleId);

        $data = $this->validated($request);

        $article->update([
            'title' => $data['title'],
            'slug' => $this->uniqueSlug($data['slug'] ?? null, $data['title'], $article->id),
            'excerpt' => $data['excerpt'] ?? null,
            'body' => $data['body'],
            'image' => $data['image'] ?? null,
            'author' => $data['author'] ?? null,
            'is_published' => $request->boolean('is_published'),
            'published_at' => $article->published_at ?? ($request->boolean('is_published') ? now() : null),
        ]);

        $this->logActivity('article.update', 'Article', $article->id, 'Updated article ' . $article->title);

        return back()->with('success', 'Article updated.');
    }

    public function toggle($articleId)
    {
        $article = Article::findOrFail((int) $articleId);

        $article->update([
            'is_published' => ! $article->is_published,
            'published_at' => $article->is_published ? ($article->published_at ?? now()) : $article->published_at,
        ]);

        $this->logActivity($article->is_published ? 'article.publish' : 'article.unpublish', 'Article', $article->id,
            ($article->is_published ? 'Published' : 'Unpublished') . ' article ' . $article->title);

        return back()->with('success', 'Article ' . ($article->is_published ? 'published.' : 'unpublished.'));
    }

    public function destroy($articleId)
    {
        $article = Article::findOrFail((int) $articleId);

        $this->logActivity('article.delete', 'Article', $article->id, 'Deleted article ' . $article->title);

        $article->delete();

        return back()->with('success', 'Article deleted.');
    }

    protected function uniqueSlug(?string $slug, string $title, $ignoreId = null): string
    {
        $base = $slug && trim($slug) !== '' ? Str::slug($slug) : Str::slug($title);
        $candidate = $base;
        $i = 2;

        while (Article::where('slug', $candidate)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $candidate = $base . '-' . $i++;
        }

        return $candidate;
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'image' => ['nullable', 'string', 'max:500'],
            'author' => ['nullable', 'string', 'max:150'],
            'is_published' => ['nullable', 'boolean'],
        ]);
    }
}