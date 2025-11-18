<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\CategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
            $categories = $this->categoryRepository->paginate(10);
            return view('dashboard.categories.index', compact('categories'));
    }

    public function show(int $id)
    {
            $category = $this->categoryRepository->find($id);
            return view('dashboard.categories.show', compact('category'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:500',
        ]);

        try {
            $this->categoryRepository->create($validated);
            return redirect()->route('dashboard.categories.index')
                             ->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create category. Please try again.'])
                         ->withInput();
        }
    }

    public function edit(int $id)
    {
        try {
            $category = $this->categoryRepository->find($id);
            return view('dashboard.categories.edit', compact('category'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.categories.index')
                             ->withErrors(['error' => 'Category not found or could not be loaded.']);
        }
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string|max:500',
        ]);

        try {
            $this->categoryRepository->update($id, $validated);
            return redirect()->route('dashboard.categories.index')
                             ->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update category. Please try again.'])
                         ->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->categoryRepository->destroy($id);
            return redirect()->route('dashboard.categories.index')
                             ->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.categories.index')
                             ->withErrors(['error' => 'Failed to delete category. Please try again.']);
        }
    }
}
