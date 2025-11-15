@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="max-w-6xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="flex justify-between items-center bg-white rounded-lg border border-gray-200 p-4">
        <div>
            <h1 class="text-lg font-semibold text-gray-900">Projects</h1>
            <p class="text-xs text-gray-500 mt-1">Manage all projects in your portfolio</p>
        </div>
        <a href="{{ route('dashboard.projects.create') }}" 
           class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-700 transition duration-150 ease-in-out">
            + Create Project
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded-lg">
            <p class="text-green-800 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-lg border border-gray-200 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">

                @forelse($projects as $index => $project)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $index + 1 }}</td>

                        <td class="px-4 py-2">
                            <img src="{{ asset('storage/'.$project->image) }}" class="h-10 w-16 object-cover rounded border">
                        </td>

                        <td class="px-4 py-2 text-sm text-gray-900">{{ $project->title }}</td>

                        <td class="px-4 py-2 text-sm text-gray-700">
                            {{ $project->projectType->name ?? '-' }}
                        </td>

                        <td class="px-4 py-2 text-sm text-gray-500">{{ $project->start_date }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $project->end_date }}</td>

                        <td class="px-4 py-2 text-sm text-gray-700">{{ $project->display_order }}</td>

                        <td class="px-4 py-2 text-center flex justify-center gap-2">
                            <a href="{{ route('dashboard.projects.show', $project->id) }}" 
                               class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200">View</a>

                            <a href="{{ route('dashboard.projects.edit', $project->id) }}" 
                               class="px-2 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>

                            <form action="{{ route('dashboard.projects.destroy', $project->id) }}" 
                                  method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this project?')"
                                        class="px-2 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500 text-sm">
                            No projects found. 
                            <a href="{{ route('dashboard.projects.create') }}" class="text-indigo-600 underline">
                                Create one
                            </a>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>
@endsection
