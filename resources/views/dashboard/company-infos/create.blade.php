@extends('layouts.app')

@section('title', 'Create Company Info')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">Create New Company Info</h1>
        <p class="text-xs text-gray-500 mt-1">Fill in the details to add a new company info</p>
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
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <form method="POST" action="{{ route('dashboard.company-infos.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">

                {{-- Logo --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Logo <span class="text-red-500">*</span></label>
                    <input type="file" name="logo" class="block w-full text-sm text-gray-700">
                </div>

                {{-- Name --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Company Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                           class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Phone --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" 
                           class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Address --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Address</label>
                    <textarea name="address" rows="3" class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm">{{ old('address') }}</textarea>
                </div>

                {{-- Is Active --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                    <label class="text-sm text-gray-700">Set as active company info</label>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-2 pt-3">
                    <a href="{{ route('dashboard.company-infos.index') }}" class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">Cancel</a>
                    <button type="submit" class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">Create Company Info</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
