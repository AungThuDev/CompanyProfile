@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="max-w-6xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="flex justify-between items-center bg-white rounded-lg border border-gray-200 p-4">
        <div>
            <h1 class="text-lg font-semibold text-gray-900">Users</h1>
            <p class="text-xs text-gray-500 mt-1">Manage all users in your platform</p>
        </div>
        <a href="{{ route('dashboard.users.create') }}" 
           class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-700 transition duration-150 ease-in-out">
            + Create User
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded-lg">
            <p class="text-green-800 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Users Table --}}
    <div class="bg-white rounded-lg border border-gray-200 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Account Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($users as $index => $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $user->email }}</td>
                        <td class="px-4 py-2 text-sm">
                            @if($user->email_verified_at)
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">Verified</span>
                            @else
                                <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">Unverified</span>
                            @endif
                        </td>                        
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $user->phone ?? 'N/A'}}</td>
                        <td class="px-4 py-2 text-sm">
                            @if($user->suspended_at)
                                <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">Suspended</span>
                            @else
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">Active</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-2 text-center flex justify-center gap-2">
                            <a href="{{ route('dashboard.users.show', $user->id) }}" 
                               class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200">View</a>
                        
                            <form action="{{ route('dashboard.users.suspend', $user->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to {{ $user->suspended_at ? 'unsuspend' : 'suspend' }} this user?')"
                                        class="px-2 py-1 text-xs {{ $user->suspended_at ? 'bg-green-600 hover:bg-green-700' : 'bg-amber-600 hover:bg-amber-700' }} text-white rounded">
                                        {{ $user->suspended_at ? 'Unsuspend' : 'Suspend' }}
                                </button>
                            </form>
                        </td>                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500 text-sm">
                            No users found. <a href="{{ route('dashboard.users.create') }}" class="text-indigo-600 underline">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
