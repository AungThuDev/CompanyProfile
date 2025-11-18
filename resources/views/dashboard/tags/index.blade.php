@extends('layouts.app')

@section('title', 'Tags')

@section('content')
<div class="max-w-6xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="flex justify-between items-center bg-white rounded-lg border border-gray-200 p-4">
        <div>
            <h1 class="text-lg font-semibold text-gray-900">Tags</h1>
            <p class="text-xs text-gray-500 mt-1">Manage all tags in your platform</p>
        </div>
        <a href="{{ route('dashboard.tags.create') }}" 
           class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-700">
            + Create Tag
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded-lg">
            <p class="text-green-800 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Errors --}}
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-lg">
            <ul class="text-xs text-red-700 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-lg border border-gray-200 overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created At</th>
                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($tags as $tag)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-700">
                            {{ ($tags->currentPage() - 1) * $tags->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $tag->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ Str::limit($tag->description, 60) ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $tag->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-2 text-center flex justify-center gap-2">
                            <a href="{{ route('dashboard.tags.show', $tag->id) }}" 
                               class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200">View</a>
                            <a href="{{ route('dashboard.tags.edit', $tag->id) }}" 
                               class="px-2 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
                            
                            <form action="{{ route('dashboard.tags.destroy', $tag->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" 
                                        class="px-2 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500">
                            No tags found.
                            <a href="{{ route('dashboard.tags.create') }}" class="text-indigo-600 underline">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4 p-4 border-t border-gray-200">
            {{ $tags->links() }}
        </div>
    </div>

</div>
@endsection
