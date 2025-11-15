@extends('layouts.app')

@section('title', 'Project Details')

@section('content')
<div class="max-w-4xl mx-auto my-8">

    {{-- Card Container --}}
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">

        {{-- Header --}}
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">{{ $project->title }}</h1>
            <p class="text-gray-500 text-sm">Full information about this project</p>
        </div>

        {{-- Image --}}
        <div class="p-6 flex justify-center border-b border-gray-200">
            <img src="{{ asset('storage/' . $project->image) }}" 
                 class="h-28 rounded object-cover">
        </div>

        {{-- Details --}}
        <div class="p-6 space-y-3">

            <p class="text-gray-700">
                <span class="font-semibold">Project Type:</span>
                {{ $project->type?->name ?? 'N/A' }}
            </p>

            <p class="text-gray-700">
                <span class="font-semibold">Slug:</span> {{ $project->slug }}
            </p>

            <p class="text-gray-700">
                <span class="font-semibold">Project URL:</span>
                @if ($project->project_url)
                    <a href="{{ $project->project_url }}" target="_blank" class="text-blue-600 underline">
                        {{ $project->project_url }}
                    </a>
                @else
                    N/A
                @endif
            </p>

            <p class="text-gray-700">
                <span class="font-semibold">Description:</span>
                {{ $project->description ?? 'N/A' }}
            </p>

            <p class="text-gray-700">
                <span class="font-semibold">Display Order:</span>
                {{ $project->display_order }}
            </p>

            <p class="text-gray-700">
                <span class="font-semibold">Start Date:</span>
                {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}
            </p>

            <p class="text-gray-700">
                <span class="font-semibold">End Date:</span>
                {{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}
            </p>

            <p class="text-gray-700">
                <span class="font-semibold">Status:</span>
                <span class="px-2 py-1 text-xs rounded 
                    {{ $project->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $project->is_active ? 'Active' : 'Inactive' }}
                </span>
            </p>

            <p class="text-gray-700">
                <span class="font-semibold">Creator:</span>
                {{ $project->creator->name ?? 'N/A' }}
            </p>

            <p class="text-gray-700">
                <span class="font-semibold">Updator:</span>
                {{ $project->updator->name ?? 'N/A' }}
            </p>

            <p class="text-gray-700">
                <span class="font-semibold">Created At:</span>
                {{ $project->created_at->format('M d, Y') }}
            </p>

            <p class="text-gray-700">
                <span class="font-semibold">Updated At:</span>
                {{ $project->updated_at->format('M d, Y') }}
            </p>

            {{-- Actions --}}
            <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('dashboard.projects.edit', $project->id) }}" 
                   class="px-5 py-2 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Edit
                </a>

                <a href="{{ route('dashboard.projects.index') }}" 
                   class="px-5 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                    Back
                </a>
            </div>

        </div>

    </div>

</div>
@endsection
