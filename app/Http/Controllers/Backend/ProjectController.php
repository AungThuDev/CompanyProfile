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

    public function __construct(ProjectRepositoryInterface $projectRepository, ProjectTypeRepositoryInterface $projectTypeRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->projectTypeRepository = $projectTypeRepository;
    }

    public function index()
    {
        $projects = $this->projectRepository->all();
        return view('dashboard.projects.index', compact('projects'));
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
            'title'          => ['required', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],
            'project_url'    => ['nullable', 'url'],
            'start_date'     => ['required', 'date'],
            'end_date'       => ['required', 'date', 'after_or_equal:start_date'],
            'display_order'  => ['required', 'integer', 'min:1'],
            'image'          => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $this->projectRepository->create($validated, $request->file('image'));

        return redirect()->route('dashboard.projects.index')->with('success', 'Project created successfully.');
    }

    public function show(int $id)
    {
        $project = $this->projectRepository->find($id);
        return view('dashboard.projects.show', compact('project'));
    }

    public function edit(int $id)
    {
        $project = $this->projectRepository->find($id);
        $projectTypes = $this->projectTypeRepository->all();
        return view('dashboard.projects.edit', compact('project', 'projectTypes'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'project_type_id' => ['required', 'exists:project_types,id'],
            'title'          => ['required', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],
            'project_url'    => ['nullable', 'url'],
            'start_date'     => ['required', 'date'],
            'end_date'       => ['required', 'date', 'after_or_equal:start_date'],
            'display_order'  => ['required', 'integer', 'min:1'],
            'image'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $this->projectRepository->update($id, $validated, $request->file('image'));

        return redirect()->route('dashboard.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->projectRepository->destroy($id);
        return redirect()->route('dashboard.projects.index')->with('success', 'Project deleted successfully.');
    }
}
