@extends('layouts.app')

@section('title', 'Project Type Details')

@section('content')
<div class="max-w-4xl mx-auto my-8">

    {{-- Card Container --}}
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">

        <div class="p-6 space-y-4">
            <h1 class="text-2xl font-bold text-gray-900">{{ $projectType->name }}</h1>
            <p class="text-gray-500 text-sm">Detailed information about this project type</p>

            <div class="border-t border-gray-200 pt-4 space-y-2">
                <p class="text-gray-700"><span class="font-semibold">Description:</span> {{ $projectType->description ?? 'N/A' }}</p>
                <p class="text-gray-700"><span class="font-semibold">Active:</span> 
                    {{ $projectType->is_active ? 'Yes' : 'No' }}
                </p>
                <p class="text-gray-700"><span class="font-semibold">Slug:</span> {{ $projectType->slug }}</p>
                <p class="text-gray-700"><span class="font-semibold">Creator:</span> {{ $projectType->creator->name ?? 'N/A' }}</p>
                <p class="text-gray-700"><span class="font-semibold">Updator:</span> {{ $projectType->updator->name ?? 'N/A' }}</p>
                <p class="text-gray-700"><span class="font-semibold">Created At:</span> {{ $projectType->created_at->format('M d, Y') }}</p>
                <p class="text-gray-700"><span class="font-semibold">Updated At:</span> {{ $projectType->updated_at->format('M d, Y') }}</p>
            </div>

            {{-- Actions --}}
            <div class="flex flex-wrap gap-3 pt-4">
                <a href="{{ route('dashboard.project-types.edit', $projectType->id) }}" 
                   class="px-5 py-2 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Edit</a>
                <a href="{{ route('dashboard.project-types.index') }}" 
                   class="px-5 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Back</a>
            </div>
        </div>

    </div>

</div>
@endsection
