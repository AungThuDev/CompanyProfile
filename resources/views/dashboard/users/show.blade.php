@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="max-w-4xl mx-auto my-8 space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h1>
        <p class="text-xs text-gray-500 mt-1">Detailed information about this user</p>
    </div>

    {{-- Details Card --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">

        {{-- User Info Grid --}}
        <div class="grid grid-cols-2 gap-4">
            {{-- Name --}}
            <div>
                <label class="block text-xs font-medium text-gray-700">Name</label>
                <p class="mt-1 text-gray-900">{{ $user->name }}</p>
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-xs font-medium text-gray-700">Email</label>
                <p class="mt-1 text-gray-900">{{ $user->email }}</p>
            </div>

            {{-- Email Status --}}
            <div>
                <label class="block text-xs font-medium text-gray-700">Email Status</label>
                <p class="mt-1">
                    @if($user->email_verified_at)
                         <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
                              Verified on {{ $user->email_verified_at->format('M d, Y') }}
                         </span>
                    @else
                         <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">Unverified</span>
                    @endif
                </p>
            </div>

            {{-- Suspension Status --}}
            <div>
                <label class="block text-xs font-medium text-gray-700">Account Status</label>
                <p class="mt-1">
                    @if($user->suspended_at)
                        <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">
                            Suspended on {{ $user->suspended_at->format('M d, Y') }}
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">Active</span>
                    @endif
                </p>
            </div>

            {{-- Phone --}}
            <div>
                <label class="block text-xs font-medium text-gray-700">Phone</label>
                <p class="mt-1 text-gray-900">{{ $user->phone ?? 'N/A' }}</p>
            </div>

            {{-- Address --}}
            <div class="col-span-2">
                <label class="block text-xs font-medium text-gray-700">Address</label>
                <p class="mt-1 text-gray-900">{{ $user->address ?? 'N/A' }}</p>
            </div>

            {{-- Bio --}}
            <div class="col-span-2">
                <label class="block text-xs font-medium text-gray-700">Bio</label>
                <p class="mt-1 text-gray-900">{{ $user->bio ?? 'N/A' }}</p>
            </div>

            {{-- Created At --}}
            <div>
                <label class="block text-xs font-medium text-gray-700">Created At</label>
                <p class="mt-1 text-gray-900">{{ $user->created_at->format('M d, Y') }}</p>
            </div>

            {{-- Updated At --}}
            <div>
                <label class="block text-xs font-medium text-gray-700">Updated At</label>
                <p class="mt-1 text-gray-900">{{ $user->updated_at->format('M d, Y') }}</p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-2 pt-4 border-t border-gray-200">
            <a href="{{ route('dashboard.users.index') }}" 
               class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
               Back
            </a>
        </div>

    </div>

</div>
@endsection
