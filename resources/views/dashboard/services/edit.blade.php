@extends('layouts.app')

@section('title', 'Edit Service')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">Edit Service</h1>
        <p class="text-xs text-gray-500 mt-1">Update the service details</p>
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
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <form method="POST" action="{{ route('dashboard.services.update', $service->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="space-y-4">

                {{-- Title --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $service->title) }}" 
                           class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Description</label>
                    <textarea name="description" rows="3" class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm">{{ old('description', $service->description) }}</textarea>
                </div>

                {{-- Display Order --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Display Order <span class="text-red-500">*</span></label>
                    <input type="number" name="display_order" value="{{ old('display_order', $service->display_order) }}" 
                           class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                </div>

                {{-- Current Image --}}
                <div class="flex items-center gap-4">
                    <div class="w-24 h-24 rounded-lg overflow-hidden ring-2 ring-indigo-100">
                        <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Change Image</label>
                        <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-600">
                        <p class="text-xs text-gray-400 mt-1">Optional. JPG, JPEG, PNG, WEBP. Max 2MB.</p>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-2 pt-3">
                    <a href="{{ route('dashboard.services.index') }}" class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">Cancel</a>
                    <button type="submit" class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">Update Service</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
