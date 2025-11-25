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

    {{-- Reply Section --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4 space-y-3">
        <h2 class="text-sm font-semibold text-gray-700">Reply</h2>

        @if($contact->reply_message)
            <div class="p-3 bg-green-50 border border-green-200 rounded text-gray-700 space-y-1">
                <p><strong>Replied at:</strong> {{ $contact->replied_at->format('Y-m-d H:i') }}</p>
                <p><strong>Replied by:</strong> {{ $contact->repliedBy?->name ?? 'N/A' }}</p>
                <p>{{ $contact->reply_message }}</p>
            </div>
        @endif

        <form action="{{ route('dashboard.contacts.reply', $contact->id) }}" method="POST" class="space-y-3">
            @csrf
            <textarea name="reply_message" rows="5" 
                      class="w-full border border-gray-300 rounded p-2 text-sm"
                      placeholder="Write your reply here..."></textarea>

            @error('reply_message')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror

            <button type="submit" 
                    class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                Send Reply
            </button>
        </form>
    </div>

</div>
@endsection
