@extends('layouts.app')

@section('title', 'Company Info')

@section('content')
<div class="max-w-6xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="flex justify-between items-center bg-white rounded-lg border border-gray-200 p-4">
        <div>
            <h1 class="text-lg font-semibold text-gray-900">Company Info</h1>
            <p class="text-xs text-gray-500 mt-1">Manage your platform's company info</p>
        </div>
        <a href="{{ route('dashboard.company-infos.create') }}" 
           class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-700 transition duration-150 ease-in-out">
            + Create Company Info
        </a>
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

    {{-- Company Info Table --}}
    <div class="bg-white rounded-lg border border-gray-200 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($companyInfos as $index => $companyInfo)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">
                            <img src="{{ asset('storage/' . $companyInfo->logo) }}" class="h-12 w-12 object-contain rounded">
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $companyInfo->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $companyInfo->email }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $companyInfo->phone ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ Str::limit($companyInfo->address, 60) ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-sm">
                            @if($companyInfo->is_active)
                                <span class="inline-block px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded">Active</span>
                            @else
                                <span class="inline-block px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded">Inactive</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $companyInfo->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-2 text-center flex justify-center gap-2">
                            <a href="{{ route('dashboard.company-infos.show', $companyInfo->id) }}" 
                               class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200">View</a>
                            <a href="{{ route('dashboard.company-infos.edit', $companyInfo->id) }}" 
                               class="px-2 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
                            <form action="{{ route('dashboard.company-infos.destroy', $companyInfo->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this company info?')"
                                        class="px-2 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-4 text-center text-gray-500 text-sm">
                            No company info found. <a href="{{ route('dashboard.company-infos.create') }}" class="text-indigo-600 underline">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
