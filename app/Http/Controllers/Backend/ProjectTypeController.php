<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\ProjectTypeRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    protected ProjectTypeRepositoryInterface $projectTypeRepository;

    public function __construct(ProjectTypeRepositoryInterface $projectTypeRepository)
    {
        $this->projectTypeRepository = $projectTypeRepository;
    }

    public function index()
    {
        $projectTypes = $this->projectTypeRepository->paginate();
        return view('dashboard.project-types.index', compact('projectTypes'));
    }

    public function show(int $id)
    {
        $projectType = $this->projectTypeRepository->find($id);
        return view('dashboard.project-types.show', compact('projectType'));
    }

    public function create()
    {
        return view('dashboard.project-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        try {
            $this->projectTypeRepository->create($validated);
            return redirect()
                ->route('dashboard.project-types.index')
                ->with('success', 'Project type created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to create project type. Please try again.'])
                ->withInput();
        }
    }

    public function edit(int $id)
    {
        try {
            $projectType = $this->projectTypeRepository->find($id);
            return view('dashboard.project-types.edit', compact('projectType'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.project-types.index')
                ->withErrors(['error' => 'Project type not found or cannot be loaded.']);
        }
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'display_order' => ['required', 'integer', 'min:1'],
        ]);

        try {
            $this->projectTypeRepository->update($id, $validated);
            return redirect()
                ->route('dashboard.project-types.index')
                ->with('success', 'Project type updated successfully.');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to update project type. Please try again.'])
                ->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->projectTypeRepository->destroy($id);
            return redirect()
                ->route('dashboard.project-types.index')
                ->with('success', 'Project type deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.project-types.index')
                ->withErrors(['error' => 'Failed to delete project type. Please try again.']);
        }
    }
}
