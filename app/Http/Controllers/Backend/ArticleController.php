<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\ArticleRepositoryInterface;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        $articles = $this->articleRepository->paginate();
        return view('dashboard.articles.index', compact('articles'));
    }

    public function show(int $id)
    {
        try {
            $article = $this->articleRepository->find($id);
            return view('dashboard.articles.show', compact('article'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.articles.index')
                             ->withErrors(['error' => 'Article not found.']);
        }
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.articles.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title'   => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image'   => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'tags'    => ['nullable', 'array'],
            'tags.*'  => ['exists:tags,id'],
        ]);

        try {
            $this->articleRepository->create(
                $validated,
                $validated['tags'] ?? [],
                $request->file('image')
            );

            return redirect()->route('dashboard.articles.index')
                             ->with('success', 'Article created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create article.'])->withInput();
        }
    }

    public function edit(int $id)
    {
        try {
            $article = $this->articleRepository->find($id);
            $categories = Category::all();
            $tags = Tag::all();

            return view('dashboard.articles.edit', compact('article', 'categories', 'tags'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.articles.index')
                             ->withErrors(['error' => 'Article not found or cannot be loaded.']);
        }
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'category_id'  => ['required', 'exists:categories,id'],
            'title'         => ['required', 'string', 'max:255'],
            'content'       => ['required', 'string'],
            'display_order' => ['required', 'integer', 'min:1'],
            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'tags'          => ['nullable', 'array'],
            'tags.*'        => ['exists:tags,id'],
        ]);

        try {
            $this->articleRepository->update(
                $id,
                $validated,
                $validated['tags'] ?? [],
                $request->file('image')
            );

            return redirect()->route('dashboard.articles.index')
                             ->with('success', 'Article updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update article.'])->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->articleRepository->destroy($id);

            return redirect()->route('dashboard.articles.index')
                             ->with('success', 'Article deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.articles.index')
                             ->withErrors(['error' => 'Failed to delete article.']);
        }
    }
}
