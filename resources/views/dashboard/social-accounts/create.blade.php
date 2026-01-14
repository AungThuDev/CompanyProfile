@extends('layouts.app')

@section('title', 'Create Social Account')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    <div class="bg-white border rounded-lg p-4">
        <h1 class="text-lg font-semibold text-gray-900">Create New Social Account</h1>
        <p class="text-xs text-gray-500 mt-1">Add a new social account for this company</p>
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

    {{-- Form --}}
    <div class="bg-white border rounded-lg p-4">
        <form method="POST" action="{{ route('dashboard.social-accounts.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="space-y-4">

                {{-- Name --}}
                <div>
                    <label class="block text-xs font-medium">Name *</label>
                    <input type="text" name="name" class="w-full border rounded px-3 py-2 text-sm">
                </div>

                {{-- Link --}}
                <div>
                    <label class="block text-xs font-medium">Account Link *</label>
                    <input type="url" name="account_link" class="w-full border rounded px-3 py-2 text-sm">
                </div>

                {{-- Logo --}}
                <div>
                    <label class="block text-xs font-medium">Logo *</label>
                    <input type="file" name="logo" accept="image/*" class="w-full text-sm">
                    <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP – max 2MB</p>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-2 pt-3">
                    <a href="{{ route('dashboard.social-accounts.index') }}" 
                       class="px-4 py-2 bg-gray-100 rounded text-sm text-gray-700">Cancel</a>

                    <button class="px-4 py-2 bg-indigo-600 text-white rounded text-sm">
                        Create Account
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
