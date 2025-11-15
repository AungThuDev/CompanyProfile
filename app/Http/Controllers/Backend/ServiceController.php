<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Backend\ServiceRepositoryInterface;
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
        $services = $this->serviceRepository->all();
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
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'display_order' => ['required', 'integer', 'min:1'],
            'image'         => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $this->serviceRepository->create(
            $validated,
            $request->file('image')
        );

        return redirect()
            ->route('dashboard.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        $service = $this->serviceRepository->find($id);
        return view('dashboard.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'display_order' => ['required', 'integer', 'min:1'],
            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $this->serviceRepository->update(
            $id,
            $validated,
            $request->file('image') 
        );

        return redirect()
            ->route('dashboard.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $this->serviceRepository->destroy($id);

        return redirect()
            ->route('dashboard.services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
