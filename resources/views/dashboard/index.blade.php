@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    {{-- Users Card --}}
    <a href="{{ route('dashboard.users.index') }}" class="block bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition">
        <h3 class="text-sm font-medium text-gray-600">Users</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">{{ $userCount }}</p>
    </a>

    {{-- Project Types Card --}}
    <a href="{{ route('dashboard.project-types.index') }}" class="block bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition">
        <h3 class="text-sm font-medium text-gray-600">Project Types</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">{{ $projectTypeCount }}</p>
    </a>

    {{-- Projects Card --}}
    <a href="{{ route('dashboard.projects.index') }}" class="block bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition">
        <h3 class="text-sm font-medium text-gray-600">Projects</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">{{ $projectCount }}</p>
    </a>

    {{-- Services Card --}}
    <a href="{{ route('dashboard.services.index') }}" class="block bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition">
        <h3 class="text-sm font-medium text-gray-600">Services</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">{{ $serviceCount }}</p>
    </a>

    {{-- Categories Card --}}
    <a href="{{ route('dashboard.categories.index') }}" class="block bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition">
        <h3 class="text-sm font-medium text-gray-600">Categories</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">{{ $categoryCount }}</p>
    </a>

    {{-- Tags Card --}}
    <a href="{{ route('dashboard.tags.index') }}" class="block bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition">
        <h3 class="text-sm font-medium text-gray-600">Tags</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">{{ $tagCount }}</p>
    </a>

    {{-- Articles Card --}}
    <a href="{{ route('dashboard.articles.index') }}" class="block bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition">
        <h3 class="text-sm font-medium text-gray-600">Articles</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">{{ $articleCount }}</p>
    </a>

    {{-- Social Accounts Card --}}
    <a href="{{ route('dashboard.social-accounts.index') }}" class="block bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition">
        <h3 class="text-sm font-medium text-gray-600">Social Accounts</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">{{ $socialAccountCount }}</p>
    </a>

    {{-- Company Infos Card --}}
    <a href="{{ route('dashboard.company-infos.index') }}" class="block bg-white p-5 rounded-lg border border-gray-200 hover:shadow-md transition">
        <h3 class="text-sm font-medium text-gray-600">Company Infos</h3>
        <p class="text-2xl font-bold mt-2 text-gray-900">{{ $companyInfoCount }}</p>
    </a>
</div>
@endsection
