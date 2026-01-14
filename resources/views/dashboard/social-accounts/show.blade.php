@extends('layouts.app')

@section('title', 'Social Account Details')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    <div class="bg-white border rounded p-4">
        <h1 class="text-lg font-semibold text-gray-900">{{ $account->name }}</h1>
        <p class="text-xs text-gray-500 mt-1">Detailed info about this social account</p>
    </div>

    <div class="bg-white border rounded p-6 space-y-4">

        {{-- Logo --}}
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . $account->logo) }}"
                 class="h-32 w-32 rounded object-cover border">
        </div>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="text-xs font-medium">Name</label>
                <p class="mt-1">{{ $account->name }}</p>
            </div>

            <div>
                <label class="text-xs font-medium">Display Order</label>
                <p class="mt-1">{{ $account->display_order }}</p>
            </div>

            <div class="col-span-2">
                <label class="text-xs font-medium">Account Link</label>
                <p class="mt-1">
                    <a href="{{ $account->account_link }}" 
                       class="text-indigo-600 underline" target="_blank">
                       {{ $account->account_link }}
                    </a>
                </p>
            </div>

            <div>
                <label class="text-xs font-medium">Created At</label>
                <p class="mt-1">{{ $account->created_at->format('M d, Y') }}</p>
            </div>

            <div>
                <label class="text-xs font-medium">Updated At</label>
                <p class="mt-1">{{ $account->updated_at->format('M d, Y') }}</p>
            </div>

        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('dashboard.social-accounts.index') }}"
               class="px-4 py-2 bg-gray-100 text-gray-700 rounded text-sm">
                Back
            </a>

            <a href="{{ route('dashboard.social-accounts.edit', $account->id) }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded text-sm">
                Edit
            </a>
        </div>

    </div>
</div>
@endsection
