@extends('layouts.app')

@section('title', 'Category Details')

@section('content')
<div class="max-w-4xl mx-auto my-8 space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h1>
        <p class="text-xs text-gray-500 mt-1">Detailed information about this category</p>
    </div>

    {{-- Details Card --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-700">Name</label>
                <p class="mt-1 text-gray-900">{{ $category->name }}</p>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Slug</label>
                <p class="mt-1 text-gray-900">{{ $category->slug }}</p>
            </div>
            <div class="col-span-2">
                <label class="block text-xs font-medium text-gray-700">Description</label>
                <p class="mt-1 text-gray-900">{{ $category->description ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Creator</label>
                <p class="mt-1 text-gray-900">{{ $category->creator->name ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Updater</label>
                <p class="mt-1 text-gray-900">{{ $category->updator->name ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Created At</label>
                <p class="mt-1 text-gray-900">{{ $category->created_at->format('M d, Y') }}</p>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Updated At</label>
                <p class="mt-1 text-gray-900">{{ $category->updated_at->format('M d, Y') }}</p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('dashboard.categories.index') }}" 
               class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
               Back
            </a>
            <a href="{{ route('dashboard.categories.edit', $category->id) }}" 
               class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
               Edit
            </a>
        </div>

    </div>

</div>
@endsection
