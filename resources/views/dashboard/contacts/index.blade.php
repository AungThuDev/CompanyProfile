@extends('layouts.app')

@section('title', 'Contact Messages')

@section('content')
<div class="max-w-6xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="flex justify-between items-center bg-white rounded-lg border border-gray-200 p-4">
        <div>
            <h1 class="text-lg font-semibold text-gray-900">Contact Messages</h1>
            <p class="text-xs text-gray-500 mt-1">Manage messages sent from Contact Form</p>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded-lg">
            <p class="text-green-800 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Error Messages --}}
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
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Received At</th>
                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">

                @forelse($contacts as $index => $msg)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $index + 1 }}</td>

                        <td class="px-4 py-2 text-sm text-gray-900">{{ $msg->name }}</td>

                        <td class="px-4 py-2 text-sm text-gray-700">{{ $msg->email }}</td>

                        <td class="px-4 py-2 text-sm text-gray-900">{{ $msg->subject }}</td>

                        {{-- Status Badge --}}
                        <td class="px-4 py-2 text-sm">
                            @if(!$msg->is_read)
                                <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded-full">
                                    Unread
                                </span>
                            @elseif($msg->replies->count() > 0)
                                <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full">
                                    Replied ({{ $msg->replies->count() }})
                                </span>
                            @else
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full">
                                    Read
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-2 text-sm text-gray-700">{{ $msg->created_at->format('Y-m-d H:i') }}</td>

                        <td class="px-4 py-2 text-center flex justify-center gap-2">

                            <a href="{{ route('dashboard.contacts.show', $msg->id) }}" 
                               class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200">View</a>

                            <form action="{{ route('dashboard.contacts.destroy', $msg->id) }}" 
                                  method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this message?')"
                                        class="px-2 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center text-gray-500 text-sm">
                            No contact messages found.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4 p-4 border-t border-gray-200">
            {{ $contacts->links() }}
        </div>
    </div>

</div>
@endsection
