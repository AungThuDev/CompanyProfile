@extends('layouts.app')

@section('title', 'Project Details')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">{{ $project->title }}</h1>
        <p class="text-xs text-gray-500 mt-1">Detailed information about this project</p>
    </div>

    {{-- Details Card --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">

        {{-- Image --}}
        <div class="flex justify-center mb-4">
            @if($project->image && file_exists(storage_path('app/public/' . $project->image)))
                <img src="{{ asset('storage/' . $project->image) }}" 
                     alt="{{ $project->title }}" 
                     class="h-48 w-48 object-cover rounded-md border">
            @else
                <div class="h-48 w-48 flex items-center justify-center bg-gray-100 text-gray-400 rounded-md border">
                    No Image
                </div>
            @endif
        </div>

        {{-- Form-style Details Grid --}}
        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="block text-xs font-medium text-gray-700">Project Type</label>
                <p class="mt-1 text-gray-900">{{ $project->projectType?->name ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Display Order</label>
                <p class="mt-1 text-gray-900">{{ $project->display_order }}</p>
            </div>

            <div class="col-span-2">
                <label class="block text-xs font-medium text-gray-700">Description</label>
                <p class="mt-1 text-gray-900">{{ $project->description ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Slug</label>
                <p class="mt-1 text-gray-900">{{ $project->slug }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Project URL</label>
                <p class="mt-1 text-gray-900">
                    @if ($project->project_url)
                        <a href="{{ $project->project_url }}" target="_blank" class="text-blue-600 underline">
                            {{ $project->project_url }}
                        </a>
                    @else
                        N/A
                    @endif
                </p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Start Date</label>
                <p class="mt-1 text-gray-900">{{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">End Date</label>
                <p class="mt-1 text-gray-900">{{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Creator</label>
                <p class="mt-1 text-gray-900">{{ $project->creator->name ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Updator</label>
                <p class="mt-1 text-gray-900">{{ $project->updator->name ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Created At</label>
                <p class="mt-1 text-gray-900">{{ $project->created_at->format('M d, Y') }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Updated At</label>
                <p class="mt-1 text-gray-900">{{ $project->updated_at->format('M d, Y') }}</p>
            </div>

        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('dashboard.projects.index') }}" 
               class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
               Back
            </a>
            <a href="{{ route('dashboard.projects.edit', $project->id) }}" 
               class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
               Edit
            </a>
        </div>

    </div>

</div>
@endsection
