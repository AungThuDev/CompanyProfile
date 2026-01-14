@extends('layouts.app')

@section('title', 'Edit Social Account')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    <div class="bg-white border rounded-lg p-4">
        <h1 class="text-lg font-semibold text-gray-900">Edit Social Account</h1>
        <p class="text-xs text-gray-500 mt-1">Update social account information</p>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-lg">
            <ul class="text-xs text-red-700 list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border rounded p-4">
        <form method="POST" action="{{ route('dashboard.social-accounts.update', $account->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="space-y-4">

                {{-- Name --}}
                <div>
                    <label class="text-xs font-medium">Name *</label>
                    <input type="text" name="name" value="{{ old('name', $account->name) }}"
                           class="w-full border rounded px-3 py-2 text-sm">
                </div>

                {{-- Link --}}
                <div>
                    <label class="text-xs font-medium">Account Link *</label>
                    <input type="url" name="account_link" 
                           value="{{ old('account_link', $account->account_link) }}"
                           class="w-full border rounded px-3 py-2 text-sm">
                </div>

                {{-- Display Order --}}
                <div>
                    <label class="text-xs font-medium">Display Order *</label>
                    <input type="number" name="display_order" 
                           value="{{ old('display_order', $account->display_order) }}"
                           class="w-full border rounded px-3 py-2 text-sm">
                </div>

                {{-- Logo --}}
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 rounded overflow-hidden border">
                        <img src="{{ asset('storage/' . $account->logo) }}" class="w-full h-full object-cover">
                    </div>

                    <div>
                        <label class="text-xs font-medium">Change Logo</label>
                        <input type="file" name="logo" accept="image/*" class="text-sm">
                        <p class="text-xs text-gray-400">Optional</p>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-2">
                    <a href="{{ route('dashboard.social-accounts.index') }}" 
                       class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded">Cancel</a>
                    <button class="px-4 py-2 bg-indigo-600 text-white text-sm rounded">
                        Update Account
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
