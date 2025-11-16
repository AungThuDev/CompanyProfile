@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">Edit Project</h1>
        <p class="text-xs text-gray-500 mt-1">Update project details</p>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-lg">
            <ul class="text-xs text-red-700 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form action="{{ route('dashboard.projects.update', $project->id) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Project Type --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">Project Type <span class="text-red-500">*</span></label>
                <select name="project_type_id" 
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach($projectTypes as $type)
                        <option value="{{ $type->id }}" {{ $project->project_type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Title --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title"
                       value="{{ old('title', $project->title) }}"
                       class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">Description</label>
                <textarea name="description" rows="4"
                          class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm">{{ old('description', $project->description) }}</textarea>
            </div>

            {{-- Dates --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Start Date <span class="text-red-500">*</span></label>
                    <input type="date" name="start_date"
                           value="{{ old('start_date', $project->start_date) }}"
                           class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">End Date <span class="text-red-500">*</span></label>
                    <input type="date" name="end_date"
                           value="{{ old('end_date', $project->end_date) }}"
                           class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            {{-- URL + Display Order in One Row --}}
            <div class="grid grid-cols-2 gap-4">

                {{-- Project URL --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Project URL</label>
                    <input type="text" name="project_url"
                        value="{{ old('project_url', $project->project_url) }}"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm 
                                focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Display Order --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                        Display Order <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="display_order"
                        value="{{ old('display_order', $project->display_order) }}"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm 
                                focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

            </div>


            {{-- Current Image --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">Current Image</label>
                <img src="{{ asset('storage/' . $project->image) }}" 
                     class="h-24 rounded border mt-2 object-cover">
            </div>

            {{-- Upload New Image --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">Change Image</label>
                <input type="file" name="image"
                       class="block w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-2 pt-4">
                <a href="{{ route('dashboard.projects.index') }}"
                   class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">Cancel</a>

                <button type="submit"
                        class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Update Project
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
