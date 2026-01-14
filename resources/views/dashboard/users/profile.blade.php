@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="max-w-5xl mx-auto space-y-4">

    {{-- Page Header --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h1 class="text-lg font-semibold text-gray-900">Profile Settings</h1>
        <p class="text-xs text-gray-500 mt-1">Manage your account information and security</p>
    </div>

    {{-- Messages --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded-lg text-sm text-green-800">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-lg text-xs text-red-700">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Main Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Left Column: Profile Image --}}
        <div class="space-y-4">
            <div class="bg-white rounded-lg border border-gray-200 p-4 text-center">
                <form action="{{ route('dashboard.profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <label class="relative inline-block cursor-pointer">
                        <input type="file" name="profile" accept="image/*" class="hidden" onchange="this.form.submit()">
                        <div class="w-24 h-24 rounded-lg overflow-hidden ring-2 ring-indigo-100 mx-auto mb-3">
                            @if($user->profile)
                                <img src="{{ asset('storage/' . $user->profile) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-indigo-500 text-white text-3xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="absolute -bottom-1 -right-1 bg-indigo-600 rounded-full p-1 shadow-md">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </label>
                </form>
                <h3 class="text-sm font-semibold text-gray-900">{{ $user->name }}</h3>
                <p class="text-xs text-gray-500">{{ $user->email }}</p>
            </div>
        </div>

        {{-- Right Column: Profile Info --}}
        <div class="lg:col-span-2 bg-white rounded-lg border border-gray-200 p-4">
            <form method="POST" action="{{ route('dashboard.profile') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Full Name --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter your full name"
                                   class="block w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter your email"
                                   class="block w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Phone</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter your phone number"
                                   class="block w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    {{-- Address --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Address</label>
                        <div class="relative">
                            <div class="absolute top-2 left-2.5 pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}" placeholder="Enter your address"
                                   class="block w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    {{-- Bio --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-700">Bio</label>
                        <div class="relative">
                            <div class="absolute top-2 left-2.5 pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <textarea name="bio" rows="3" placeholder="Tell us about yourself..."
                                      class="block w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">{{ old('bio', $user->bio) }}</textarea>
                        </div>
                    </div>

                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <button type="submit" class="px-4 py-2 text-sm bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Save Changes</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
