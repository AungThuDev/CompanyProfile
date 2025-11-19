@extends('layouts.app')

@section('title', 'Social Accounts')

@section('content')
<div class="max-w-6xl mx-auto space-y-4">

    {{-- Header --}}
    <div class="flex justify-between items-center bg-white rounded-lg border border-gray-200 p-4">
        <div>
            <h1 class="text-lg font-semibold text-gray-900">Social Accounts</h1>
            <p class="text-xs text-gray-500 mt-1">Manage all social accounts for this company</p>
        </div>
        <a href="{{ route('dashboard.social-accounts.create') }}" 
           class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-700">
            + Add Social Account
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded-lg">
            <p class="text-green-800 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-lg border border-gray-200 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase text-left">#</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase text-left">Logo</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase text-left">Name</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase text-left">Link</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase text-left">Order</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($accounts as $index => $account)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">
                            <img src="{{ asset('storage/' . $account->logo) }}" class="h-10 w-10 object-cover rounded">
                        </td>
                        <td class="px-4 py-2 text-sm">{{ $account->name }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ $account->account_link }}" target="_blank" class="text-indigo-600 underline text-sm">
                                {{ Str::limit($account->account_link, 40) }}
                            </a>
                        </td>
                        <td class="px-4 py-2 text-sm">{{ $account->display_order }}</td>

                        <td class="px-4 py-2 text-center flex justify-center gap-2">
                            <a href="{{ route('dashboard.social-accounts.show', $account->id) }}" 
                               class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">
                                View
                            </a>
                            <a href="{{ route('dashboard.social-accounts.edit', $account->id) }}" 
                               class="px-2 py-1 text-xs bg-indigo-600 text-white rounded">
                                Edit
                            </a>
                            <form action="{{ route('dashboard.social-accounts.destroy', $account->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-2 py-1 text-xs bg-red-600 text-white rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500 text-sm">
                            No social accounts found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4 p-4 border-t">
            {{ $accounts->links() }}
        </div>
    </div>
</div>
@endsection
