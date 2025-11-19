@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="max-w-5xl mx-auto space-y-4">

    {{-- Page Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">Account Settings</h1>
        <p class="text-xs text-gray-500 mt-1">Manage your security settings and preferences</p>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded-lg">
            <p class="text-sm text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-lg">
            <ul class="list-disc list-inside text-xs text-red-700 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Change Password --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h2 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
            <span class="w-0.5 h-4 bg-indigo-600 rounded-full mr-2"></span>
            Change Password
        </h2>

        <form method="POST" action="{{ route('dashboard.settings.password') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Current Password</label>
                    <input type="password" name="current_password" class="block w-full text-sm border border-gray-300 rounded-md px-3 py-2">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" name="password" class="block w-full text-sm border border-gray-300 rounded-md px-3 py-2">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="block w-full text-sm border border-gray-300 rounded-md px-3 py-2">
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <button type="submit" class="px-4 py-2 text-sm bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Update Password
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
