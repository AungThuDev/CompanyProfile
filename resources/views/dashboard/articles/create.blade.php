@extends('layouts.app')

@section('title', 'Create Article')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">Create New Article</h1>
        <p class="text-xs text-gray-500 mt-1">Fill in the details to add a new article</p>
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
        <form method="POST" action="{{ route('dashboard.articles.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">

                {{-- Category --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" required
                            class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Title --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Content --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                        Content <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" rows="6" required
                              class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">{{ old('content') }}</textarea>
                </div>

                {{-- Tags Multiple Select --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Tags</label>
                    <select name="tags[]" multiple
                            class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Windows) or Cmd (Mac) to select multiple tags.</p>
                </div>

                {{-- Image --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                        Image <span class="text-red-500">*</span>
                    </label>
                    <input type="file" name="image" required
                           class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                </div>

                {{-- Featured Checkbox --}}
                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1"
                               class="h-4 w-4 text-indigo-600 border-gray-300 rounded"
                               {{ old('is_featured') ? 'checked' : '' }}>
                        <span class="text-sm text-gray-700">Set as Featured Article</span>
                    </label>
                    <p class="text-xs text-gray-500 mt-1">Only one article will be featured at a time.</p>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-2 pt-3">
                    <a href="{{ route('dashboard.articles.index') }}"
                       class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Create Article
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
