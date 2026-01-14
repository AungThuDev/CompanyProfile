@extends('layouts.app')

@section('title', 'Edit Company Info')

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">Edit Company Info</h1>
        <p class="text-xs text-gray-500 mt-1">Update the company info details</p>
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
        <form method="POST" action="{{ route('dashboard.company-infos.update', $companyInfo->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="space-y-4">

                {{-- Logo --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Logo</label>
                    @if($companyInfo->logo)
                        <img src="{{ asset('storage/'.$companyInfo->logo) }}" alt="Logo" class="w-24 h-24 object-contain rounded mb-2">
                    @endif
                    <input type="file" name="logo" class="block w-full text-sm text-gray-700">
                </div>

                {{-- Name --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Company Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $companyInfo->name) }}" 
                           class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $companyInfo->email) }}" 
                           class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Phone --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $companyInfo->phone) }}" 
                           class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Address --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Address</label>
                    <textarea name="address" rows="3" class="block w-full border border-gray-300 rounded-md px-3 py-2 text-sm">{{ old('address', $companyInfo->address) }}</textarea>
                </div>

                {{-- Is Active --}}
                <div class="flex items-center gap-2">
                    <input type="hidden" name="is_active" value="0">
                
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $companyInfo->is_active) ? 'checked' : '' }}>
                    <label class="text-sm text-gray-700">Set as active company info</label>
                </div>
                

                {{-- Actions --}}
                <div class="flex justify-end gap-2 pt-3">
                    <a href="{{ route('dashboard.company-infos.index') }}" class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">Cancel</a>
                    <button type="submit" class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">Update Company Info</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
