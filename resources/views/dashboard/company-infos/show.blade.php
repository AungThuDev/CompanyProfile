@extends('layouts.app')

@section('title', 'Company Info Details')

@section('content')
<div class="max-w-4xl mx-auto my-8 space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">{{ $companyInfo->name }}</h1>
        <p class="text-xs text-gray-500 mt-1">Detailed information about this company</p>
    </div>

    {{-- Details Card --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="block text-xs font-medium text-gray-700">Logo</label>
                <img src="{{ asset('storage/'.$companyInfo->logo) }}" alt="Logo" class="w-24 h-24 object-contain rounded mt-1">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Name</label>
                <p class="mt-1 text-gray-900">{{ $companyInfo->name }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Email</label>
                <p class="mt-1 text-gray-900">{{ $companyInfo->email }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Phone</label>
                <p class="mt-1 text-gray-900">{{ $companyInfo->phone ?? 'N/A' }}</p>
            </div>

            <div class="col-span-2">
                <label class="block text-xs font-medium text-gray-700">Address</label>
                <p class="mt-1 text-gray-900">{{ $companyInfo->address ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Status</label>
                @if($companyInfo->is_active)
                    <span class="inline-block px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded mt-1">Active</span>
                @else
                    <span class="inline-block px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded mt-1">Inactive</span>
                @endif
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Created By</label>
                <p class="mt-1 text-gray-900">{{ $companyInfo->creator->name ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Updated By</label>
                <p class="mt-1 text-gray-900">{{ $companyInfo->updator->name ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Created At</label>
                <p class="mt-1 text-gray-900">{{ $companyInfo->created_at->format('M d, Y') }}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Updated At</label>
                <p class="mt-1 text-gray-900">{{ $companyInfo->updated_at->format('M d, Y') }}</p>
            </div>

        </div>

        {{-- Actions --}}
        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('dashboard.company-infos.index') }}" class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">Back</a>
            <a href="{{ route('dashboard.company-infos.edit', $companyInfo->id) }}" class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
        </div>

    </div>

</div>
@endsection
