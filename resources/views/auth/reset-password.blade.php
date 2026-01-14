@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
    
    {{-- Header --}}
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Reset Password</h1>
        <p class="text-sm text-gray-500">
            Enter a new password for your account
        </p>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="space-y-2 mb-4">
            @foreach ($errors->all() as $error)
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-2 rounded-md text-sm shadow-sm">
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif

    {{-- Success --}}
    @if (session('status'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded-md text-sm shadow-sm mb-4">
            {{ session('status') }}
        </div>
    @endif

    {{-- Reset Form --}}
    <form action="{{ route('auth.reset-password') }}" method="POST" class="space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        {{-- New Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                New Password
            </label>
            <input 
                type="password" 
                id="password" 
                name="password"
                required
                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md 
                       focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="New password"
            >
        </div>

        {{-- Confirm New Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                Confirm New Password
            </label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation"
                required
                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md 
                       focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Confirm new password"
            >
        </div>

        {{-- Submit Button --}}
        <button 
            type="submit"
            class="w-full bg-indigo-600 text-white py-2 px-4 text-sm font-medium rounded-md 
                   hover:bg-indigo-700 focus:outline-none focus:ring-2 
                   focus:ring-offset-2 focus:ring-indigo-500 transition"
        >
            Reset Password
        </button>
    </form>
</div>
@endsection
