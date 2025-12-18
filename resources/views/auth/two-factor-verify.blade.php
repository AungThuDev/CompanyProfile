@extends('layouts.guest')

@section('title', 'Two-Factor Authentication')

@section('content')
<div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 max-w-md mx-auto mt-12">

    {{-- Header --}}
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Two-Factor Authentication</h1>
        <p class="text-sm text-gray-500">Enter the 6-digit code sent to your email to complete login</p>
    </div>

    {{-- Status Message --}}
    @if (session('status'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded-md text-sm shadow-sm mb-4">
        {{ session('status') }}
    </div>
    @endif

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

    {{-- 2FA Code Form --}}
    <form action="{{ route('auth.2fa.verify') }}" method="POST" class="space-y-4">
        @csrf

        <input type="hidden" name="user_id" value="{{ session('2fa:user:id') }}">

        <div>
            <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                Verification Code
            </label>
            <input 
                type="text" 
                id="code" 
                name="code"
                maxlength="6"
                required
                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md 
                       focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="123456"
            >
        </div>

        <button 
            type="submit" 
            class="w-full bg-indigo-600 text-white py-2 px-4 text-sm font-medium rounded-md 
                   hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 
                   focus:ring-indigo-500 transition">
            Verify
        </button>
    </form>

    {{-- Back to Login --}}
    <div class="text-center mt-4">
        <a href="{{ route('auth.login') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
            Back to Login
        </a>
    </div>
</div>
@endsection
