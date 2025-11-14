@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    {{-- Card example --}}
    <div class="bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition">
        <h3 class="text-sm font-medium text-gray-600">Users</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">150</p>
    </div>

    <div class="bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition">
        <h3 class="text-sm font-medium text-gray-600">Articles</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">320</p>
    </div>

    <div class="bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition">
        <h3 class="text-sm font-medium text-gray-600">Revenue</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">$12,500</p>
    </div>
</div>

{{-- Example table --}}
<div class="mt-5 bg-white rounded-lg border border-gray-200 overflow-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <tr>
                <td class="px-5 py-3 whitespace-nowrap text-sm text-gray-900">John Doe</td>
                <td class="px-5 py-3 whitespace-nowrap text-sm text-gray-500">john@example.com</td>
                <td class="px-5 py-3 whitespace-nowrap text-sm text-gray-500">Admin</td>
            </tr>
            <tr>
                <td class="px-5 py-3 whitespace-nowrap text-sm text-gray-900">Jane Smith</td>
                <td class="px-5 py-3 whitespace-nowrap text-sm text-gray-500">jane@example.com</td>
                <td class="px-5 py-3 whitespace-nowrap text-sm text-gray-500">Editor</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
