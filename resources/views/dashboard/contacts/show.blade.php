@extends('layouts.app')

@section('title', 'Contact Message Details')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4 flex justify-between items-center">
        <div>
            <h1 class="text-lg font-semibold text-gray-900">Contact Message</h1>
            <p class="text-xs text-gray-500 mt-1">View and reply to message</p>
        </div>
        <a href="{{ route('dashboard.contacts.index') }}" 
           class="px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-md shadow-sm hover:bg-gray-200">
            Back to List
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded-lg">
            <p class="text-green-800 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Contact Details --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4 space-y-2">
        <p><strong>Name:</strong> {{ $contact->name }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Subject:</strong> {{ $contact->subject }}</p>
        <p><strong>Message:</strong></p>
        <div class="p-3 bg-gray-50 rounded border text-gray-700">{{ $contact->message }}</div>
        <p><strong>Received At:</strong> {{ $contact->created_at->format('Y-m-d H:i') }}</p>
        <p><strong>IP Address:</strong> {{ $contact->ip_address ?? 'N/A' }}</p>
        <p><strong>Status:</strong> 
            @if($contact->is_read)
               <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full">
                    Read
               </span>
            @else
                <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded-full">Unread</span>
            @endif
        </p>
    </div>

    {{-- Replies Section --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4 space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-sm font-semibold text-gray-700">Replies ({{ $contact->replies->count() }})</h2>
        </div>

        {{-- Existing Replies --}}
        @if($contact->replies->count() > 0)
            <div class="space-y-3">
                @foreach($contact->replies->sortByDesc('created_at') as $reply)
                    <div class="p-4 bg-green-50 border border-green-200 rounded-lg text-gray-700 space-y-2">
                        <div class="flex justify-between items-start">
                            <div class="space-y-1">
                                <p class="text-xs text-gray-600">
                                    <strong>Replied by:</strong> {{ $reply->repliedBy?->name ?? 'System' }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $reply->created_at->format('Y-m-d H:i:s') }}
                                </p>
                            </div>
                        </div>
                        <div class="pt-2 border-t border-green-200">
                            <p class="text-sm whitespace-pre-wrap">{{ $reply->message }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-3 bg-gray-50 border border-gray-200 rounded text-gray-500 text-sm text-center">
                No replies yet. Be the first to reply!
            </div>
        @endif

        {{-- Reply Form --}}
        <div class="pt-4 border-t border-gray-200">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Add New Reply</h3>
            <form action="{{ route('dashboard.contacts.reply', $contact->id) }}" method="POST" class="space-y-3">
                @csrf
                <textarea name="reply_message" rows="5" 
                          class="w-full border border-gray-300 rounded p-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="Write your reply here..."></textarea>

                @error('reply_message')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror

                <button type="submit" 
                        class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700 transition">
                    Send Reply
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
