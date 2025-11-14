@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
    {{-- Header --}}
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Forgot Password</h1>
        <p class="text-sm text-gray-500">
            Enter your email address, and we’ll send you a link to reset your password.
        </p>
    </div>

    {{-- ✅ Session Status Message --}}
    @if (session('status'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded-md text-sm shadow-sm mb-4">
        {{ session('status') }}
    </div>
    @endif

    {{-- Error Messages --}}
    @if ($errors->any())
    <div class="space-y-2 mb-4">
        @foreach ($errors->all() as $error)
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-2 rounded-md text-sm shadow-sm">
                {{ $error }}
            </div>
        @endforeach
    </div>
    @endif

    {{-- Forgot Password Form --}}
    <form action="{{ route('auth.forgot-password') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Email Field --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Email
            </label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}"
                required 
                autofocus
                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="yourname@example.com"
            >
        </div>

        {{-- Submit Button --}}
        <button 
            type="submit" 
            class="w-full bg-indigo-600 text-white py-2 px-4 text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
        >
            Send Password Reset Link
        </button>

        {{-- Back to Login Link --}}
        <div class="text-center text-sm mt-4">
            <a href="{{ route('auth.login') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                Back to Login
            </a>
        </div>
    </form>
</div>
@endsection
