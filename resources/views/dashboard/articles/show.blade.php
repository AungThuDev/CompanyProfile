@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">{{ $article->title }}</h1>
        <p class="text-xs text-gray-500 mt-1">Detailed information about this article</p>
    </div>

    {{-- Details Card --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">

        {{-- Image --}}
        <div class="flex justify-center mb-4">
            @if($article->image && file_exists(storage_path('app/public/' . $article->image)))
                <img src="{{ asset('storage/' . $article->image) }}" 
                     alt="{{ $article->title }}" 
                     class="h-48 w-48 object-cover rounded-md border">
            @else
                <div class="h-48 w-48 flex items-center justify-center bg-gray-100 text-gray-400 rounded-md border">
                    No Image
                </div>
            @endif
        </div>

        {{-- Details Grid --}}
        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="block text-xs font-medium text-gray-700">Category</label>
                <p class="mt-1 text-gray-900">{{ $article->category?->name ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Reading Time</label>
                <p class="mt-1 text-gray-900">{{ $article->reading_time }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Featured</label>
                <p class="mt-1 text-gray-900">
                    @if($article->is_featured)
                        <span class="inline-block bg-green-100 text-green-800 px-2 py-0.5 rounded text-xs">Yes</span>
                    @else
                        <span class="inline-block bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-xs">No</span>
                    @endif
                </p>
            </div>

            <div class="col-span-2">
                <label class="block text-xs font-medium text-gray-700">Content</label>
                <p class="mt-1 text-gray-900 whitespace-pre-wrap">{{ $article->content }}</p>
            </div>

            <div class="col-span-2">
                <label class="block text-xs font-medium text-gray-700">Tags</label>
                <p class="mt-1 text-gray-900">
                    @forelse($article->tags as $tag)
                        <span class="inline-block bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-xs mr-1 mb-1">{{ $tag->name }}</span>
                    @empty
                        N/A
                    @endforelse
                </p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Display Order</label>
                <p class="mt-1 text-gray-900">{{ $article->display_order }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Creator</label>
                <p class="mt-1 text-gray-900">{{ $article->creator?->name ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Updator</label>
                <p class="mt-1 text-gray-900">{{ $article->updator?->name ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Created At</label>
                <p class="mt-1 text-gray-900">{{ $article->created_at->format('M d, Y') }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Updated At</label>
                <p class="mt-1 text-gray-900">{{ $article->updated_at->format('M d, Y') }}</p>
            </div>

        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('dashboard.articles.index') }}" 
               class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
               Back
            </a>
            <a href="{{ route('dashboard.articles.edit', $article->id) }}" 
               class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
               Edit
            </a>
        </div>

    </div>

</div>
@endsection
