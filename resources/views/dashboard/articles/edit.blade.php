@extends('layouts.app')

@section('title', 'Edit Article')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">Edit Article</h1>
        <p class="text-xs text-gray-500 mt-1">Update article details</p>
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
        <form action="{{ route('dashboard.articles.update', $article->id) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Category --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">Category <span class="text-red-500">*</span></label>
                <select name="category_id" 
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Title --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title"
                       value="{{ old('title', $article->title) }}"
                       class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Content --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">Content <span class="text-red-500">*</span></label>
                <textarea name="content" rows="6"
                          class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">{{ old('content', $article->content) }}</textarea>
            </div>

            {{-- Tags --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">Tags</label>
                <select name="tags[]" multiple 
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ $article->tags->pluck('id')->contains($tag->id) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Cmd on Mac) to select multiple tags.</p>
            </div>

            {{-- Display Order --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">
                    Display Order <span class="text-red-500">*</span>
                </label>
                <input type="number" name="display_order"
                    value="{{ old('display_order', $article->display_order) }}"
                    class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm 
                            focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Featured Checkbox --}}
            <div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1"
                           class="h-4 w-4 text-indigo-600 border-gray-300 rounded"
                           {{ old('is_featured', $article->is_featured) ? 'checked' : '' }}>
                    <span class="text-sm text-gray-700">Set as Featured Article</span>
                </label>
                <p class="text-xs text-gray-500 mt-1">Only one article will be featured at a time.</p>
            </div>

            {{-- Current Image --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">Current Image</label>
                @if($article->image && file_exists(storage_path('app/public/' . $article->image)))
                    <img src="{{ asset('storage/' . $article->image) }}" class="h-24 rounded border mt-2 object-cover">
                @else
                    <div class="h-24 w-48 flex items-center justify-center bg-gray-100 text-gray-400 rounded-md border">No Image</div>
                @endif
            </div>

            {{-- Upload New Image --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">Change Image</label>
                <input type="file" name="image"
                       class="block w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-2 pt-4">
                <a href="{{ route('dashboard.articles.index') }}"
                   class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">Cancel</a>

                <button type="submit"
                        class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Update Article
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
