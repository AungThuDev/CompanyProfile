<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\TagRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->paginate(10);
        return view('dashboard.tags.index', compact('tags'));
    }

    public function show(int $id)
    {
        $tag = $this->tagRepository->find($id);
        return view('dashboard.tags.show', compact('tag'));
    }

    public function create()
    {
        return view('dashboard.tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name'],
            'description' => ['nullable', 'string'],
        ]);

        try {
            $this->tagRepository->create($validated);

            return redirect()
                ->route('dashboard.tags.index')
                ->with('success', 'Tag created successfully!');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to create tag. Please try again.'])
                ->withInput();
        }
    }

    public function edit(int $id)
    {
        try {
            $tag = $this->tagRepository->find($id);
            return view('dashboard.tags.edit', compact('tag'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.tags.index')
                ->withErrors(['error' => 'Tag not found or could not be loaded.']);
        }
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', "unique:tags,name,$id"],
            'description' => ['nullable', 'string'],
        ]);

        try {
            $this->tagRepository->update($id, $validated);

            return redirect()
                ->route('dashboard.tags.index')
                ->with('success', 'Tag updated successfully!');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to update tag. Please try again.'])
                ->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->tagRepository->destroy($id);

            return redirect()
                ->route('dashboard.tags.index')
                ->with('success', 'Tag deleted successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.tags.index')
                ->withErrors(['error' => 'Failed to delete tag. Please try again.']);
        }
    }
}
