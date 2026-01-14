@extends('layouts.app')

@section('title', 'Service Details')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">{{ $service->title }}</h1>
        <p class="text-xs text-gray-500 mt-1">Detailed information about this service</p>
    </div>

    {{-- Details Card --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">

        {{-- Icon --}}
        <div class="flex justify-center mb-4">
            @if($service->icon && file_exists(storage_path('app/public/' . $service->icon)))
                <img src="{{ asset('storage/' . $service->icon) }}" 
                     alt="{{ $service->title }}" 
                     class="h-48 w-48 object-contain rounded-md border bg-gray-50 p-6">
            @else
                <div class="h-48 w-48 flex items-center justify-center bg-gray-100 text-gray-400 rounded-md border">
                    No Icon
                </div>
            @endif
        </div>

        {{-- Form-style Details --}}
        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="block text-xs font-medium text-gray-700">Title</label>
                <p class="mt-1 text-gray-900">{{ $service->title }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Display Order</label>
                <p class="mt-1 text-gray-900">{{ $service->display_order }}</p>
            </div>

            <div class="col-span-2">
                <label class="block text-xs font-medium text-gray-700">Description</label>
                <p class="mt-1 text-gray-900">{{ $service->description ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Slug</label>
                <p class="mt-1 text-gray-900">{{ $service->slug }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Creator</label>
                <p class="mt-1 text-gray-900">{{ $service->creator->name ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Updator</label>
                <p class="mt-1 text-gray-900">{{ $service->updator->name ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Created At</label>
                <p class="mt-1 text-gray-900">{{ $service->created_at->format('M d, Y') }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Updated At</label>
                <p class="mt-1 text-gray-900">{{ $service->updated_at->format('M d, Y') }}</p>
            </div>

        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('dashboard.services.index') }}" 
               class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
               Back
            </a>
            <a href="{{ route('dashboard.services.edit', $service->id) }}" 
               class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
               Edit
            </a>
        </div>

    </div>

</div>
@endsection
