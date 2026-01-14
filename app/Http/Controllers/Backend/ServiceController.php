<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\ServiceRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected ServiceRepositoryInterface $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        $services = $this->serviceRepository->paginate();
        return view('dashboard.services.index', compact('services'));
    }

    public function show(int $id)
    {
        $service = $this->serviceRepository->find($id);
        return view('dashboard.services.show', compact('service'));
    }

    public function create()
    {
        return view('dashboard.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ]);

        try {
            $this->serviceRepository->create($validated, $request->file('icon'));
            return redirect()
                ->route('dashboard.services.index')
                ->with('success', 'Service created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to create service. Please try again.'])
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $service = $this->serviceRepository->find($id);
            return view('dashboard.services.edit', compact('service'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.services.index')
                ->withErrors(['error' => 'Service not found or cannot be loaded.']);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'display_order' => ['required', 'integer', 'min:1'],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ]);

        try {
            $this->serviceRepository->update($id, $validated, $request->file('icon'));
            return redirect()
                ->route('dashboard.services.index')
                ->with('success', 'Service updated successfully.');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to update service. Please try again.'])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->serviceRepository->destroy($id);
            return redirect()
                ->route('dashboard.services.index')
                ->with('success', 'Service deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.services.index')
                ->withErrors(['error' => 'Failed to delete service. Please try again.']);
        }
    }
}
