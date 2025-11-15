@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="max-w-5xl mx-auto space-y-4">

    {{-- Page Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">Profile Settings</h1>
        <p class="text-xs text-gray-500 mt-1">Manage your account information and preferences</p>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded-lg">
            <div class="flex items-center">
                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-sm text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-lg">
            <div class="flex items-start">
                <svg class="w-4 h-4 text-red-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <div class="flex-1">
                    <p class="text-sm text-red-800 font-medium mb-1">Please correct the following errors:</p>
                    <ul class="list-disc list-inside text-xs text-red-700 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        
    {{-- Profile Image Card --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="text-center">

                {{-- Profile Image (Clickable Upload) --}}
                <form action="{{ route('dashboard.profile') }}" 
                    method="POST" 
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <label class="relative inline-block mb-3 cursor-pointer">
                        <input 
                            type="file" 
                            name="profile" 
                            accept="image/*"
                            class="hidden"
                            onchange="this.form.submit()">  <!-- SUBMIT THIS SMALL FORM -->

                        <div class="w-24 h-24 rounded-lg overflow-hidden ring-2 ring-indigo-100">
                            @if($user->profile)
                                <img src="{{ asset('storage/' . $user->profile) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600 text-white text-3xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <div class="absolute -bottom-1 -right-1 bg-indigo-600 rounded-full p-1.5 shadow-md">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </label>
                </form>


                {{-- User Info --}}
                <h3 class="text-sm font-semibold text-gray-900 mb-0.5">{{ $user->name }}</h3>
                <p class="text-xs text-gray-500 mb-3">{{ $user->email }}</p>

                {{-- Validation Message (optional) --}}
                @error('profile')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror

                <p class="mt-1 text-xs text-gray-400">JPG, JPEG or PNG. Max 2MB</p>
            </div>
        </div>
    </div>

        {{-- Form Card --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <form method="POST" action="{{ route('dashboard.profile') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-4">
                        
                        {{-- Personal Information Section --}}
                        <div>
                            <h2 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                                <span class="w-0.5 h-4 bg-indigo-600 rounded-full mr-2"></span>
                                Personal Information
                            </h2>
                            <div class="space-y-3">
                                
                                {{-- Name --}}
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <input type="text" 
                                               name="name"
                                               value="{{ old('name', $user->name) }}"
                                               required
                                               class="block w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out text-gray-900 placeholder-gray-400">
                                    </div>
                                    @error('name')
                                        <p class="mt-1 text-xs text-red-600 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <input type="email" 
                                               name="email"
                                               value="{{ old('email', $user->email) }}"
                                               required
                                               class="block w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out text-gray-900 placeholder-gray-400">
                                    </div>
                                    @error('email')
                                        <p class="mt-1 text-xs text-red-600 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Phone --}}
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                                        Phone Number
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                        </div>
                                        <input type="text" 
                                               name="phone"
                                               value="{{ old('phone', $user->phone) }}"
                                               class="block w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out text-gray-900 placeholder-gray-400"
                                               placeholder="Enter your phone number">
                                    </div>
                                    @error('phone')
                                        <p class="mt-1 text-xs text-red-600 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- Additional Information Section --}}
                        <div class="border-t border-gray-200 pt-4">
                            <h2 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                                <span class="w-0.5 h-4 bg-indigo-600 rounded-full mr-2"></span>
                                Additional Information
                            </h2>
                            <div class="space-y-3">
                                
                                {{-- Address --}}
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                                        Address
                                    </label>
                                    <div class="relative">
                                        <div class="absolute top-2 left-2.5 pointer-events-none">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <textarea name="address"
                                                  rows="2"
                                                  class="block w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out text-gray-900 placeholder-gray-400 resize-none"
                                                  placeholder="Enter your address">{{ old('address', $user->address) }}</textarea>
                                    </div>
                                    @error('address')
                                        <p class="mt-1 text-xs text-red-600 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Bio --}}
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                                        Bio
                                    </label>
                                    <div class="relative">
                                        <div class="absolute top-2 left-2.5 pointer-events-none">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                        <textarea name="bio"
                                                  rows="3"
                                                  class="block w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out text-gray-900 placeholder-gray-400 resize-none"
                                                  placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-400">A brief description about yourself</p>
                                    @error('bio')
                                        <p class="mt-1 text-xs text-red-600 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                            <a href="{{ route('dashboard.index') }}" 
                               class="px-4 py-2 text-sm border border-gray-300 rounded-md text-gray-700 font-medium hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-500 focus:ring-offset-1 transition duration-150 ease-in-out">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 text-sm bg-indigo-600 text-white font-medium rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:ring-offset-1 transition duration-150 ease-in-out flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Save Changes
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

@endsection
