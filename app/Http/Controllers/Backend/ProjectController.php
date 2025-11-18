<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\ProjectRepositoryInterface;
use App\Contracts\Backend\ProjectTypeRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected ProjectRepositoryInterface $projectRepository;
    protected ProjectTypeRepositoryInterface $projectTypeRepository;

    public function __construct(
        ProjectRepositoryInterface $projectRepository,
        ProjectTypeRepositoryInterface $projectTypeRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->projectTypeRepository = $projectTypeRepository;
    }

    public function index()
    {
        $projects = $this->projectRepository->paginate();
        return view('dashboard.projects.index', compact('projects'));
    }

    public function show(int $id)
    {
        $project = $this->projectRepository->find($id);
        return view('dashboard.projects.show', compact('project'));
    }

    public function create()
    {
        $projectTypes = $this->projectTypeRepository->all();
        return view('dashboard.projects.create', compact('projectTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_type_id' => ['required', 'exists:project_types,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'project_url' => ['nullable', 'url'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        try {
            $this->projectRepository->create($validated, $request->file('image'));
            return redirect()
                ->route('dashboard.projects.index')
                ->with('success', 'Project created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to create project. Please try again.'])
                ->withInput();
        }
    }

    public function edit(int $id)
    {
        try {
            $project = $this->projectRepository->find($id);
            $projectTypes = $this->projectTypeRepository->all();

            return view('dashboard.projects.edit', compact('project', 'projectTypes'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.projects.index')
                ->withErrors(['error' => 'Project not found or cannot be loaded.']);
        }
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'project_type_id' => ['required', 'exists:project_types,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'project_url' => ['nullable', 'url'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'display_order' => ['required', 'integer', 'min:1'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        try {
            $this->projectRepository->update($id, $validated, $request->file('image'));
            return redirect()
                ->route('dashboard.projects.index')
                ->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to update project. Please try again.'])
                ->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->projectRepository->destroy($id);
            return redirect()
                ->route('dashboard.projects.index')
                ->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.projects.index')
                ->withErrors(['error' => 'Failed to delete project. Please try again.']);
        }
    }
}
