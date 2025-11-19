<aside class="w-60 bg-white shadow-sm border-r border-gray-200 hidden md:flex flex-col">

    {{-- Navigation --}}
    <nav class="flex-1 p-3 space-y-2 overflow-y-auto">

        {{-- Dashboard Section --}}
        <p class="px-3 py-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Dashboard</p>
        <a 
            href="{{ route('dashboard.index') }}" 
            class="flex items-center px-3 py-2.5 text-sm text-gray-700 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition duration-200 {{ request()->routeIs('dashboard.index') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}"
        >
            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Dashboard
        </a>

        <div class="border-t border-gray-200 my-2"></div>

        {{-- User Management Section --}}
        <p class="px-3 py-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">User Management</p>
        <a 
            href="{{ route('dashboard.users.index') }}" 
            class="flex items-center px-3 py-2.5 text-sm text-gray-700 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition duration-200 {{ request()->routeIs('dashboard.users.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}"
        >
            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            Users
        </a>

        <div class="border-t border-gray-200 my-2"></div>

        {{-- Projects Section --}}
        <p class="px-3 py-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Projects</p>
        <a 
            href="{{ route('dashboard.project-types.index') }}" 
            class="flex items-center px-3 py-2.5 text-sm text-gray-700 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition duration-200 {{ request()->routeIs('dashboard.project-types.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}"
        >
            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            Project Types
        </a>
        <a 
            href="{{ route('dashboard.projects.index') }}" 
            class="flex items-center px-3 py-2.5 text-sm text-gray-700 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition duration-200 {{ request()->routeIs('dashboard.projects.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}"
        >
            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
            Projects
        </a>
        <a 
            href="{{ route('dashboard.services.index') }}" 
            class="flex items-center px-3 py-2.5 text-sm text-gray-700 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition duration-200 {{ request()->routeIs('dashboard.services.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}"
        >
            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            Services
        </a>

        <div class="border-t border-gray-200 my-2"></div>

        {{-- Content Management Section --}}
        <p class="px-3 py-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Content Management</p>
        <a 
            href="{{ route('dashboard.categories.index') }}" 
            class="flex items-center px-3 py-2.5 text-sm text-gray-700 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition duration-200 {{ request()->routeIs('dashboard.categories.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}"
        >
            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            Categories
        </a>
        <a 
            href="{{ route('dashboard.tags.index') }}" 
            class="flex items-center px-3 py-2.5 text-sm text-gray-700 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition duration-200 {{ request()->routeIs('dashboard.tags.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}"
        >
            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
            Tags
        </a>
        <a 
            href="{{ route('dashboard.articles.index') }}" 
            class="flex items-center px-3 py-2.5 text-sm text-gray-700 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition duration-200 {{ request()->routeIs('dashboard.articles.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}"
        >
            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"></path>
            </svg>
            Articles
        </a>

        <div class="border-t border-gray-200 my-2"></div>

        {{-- Settings Section --}}
        <p class="px-3 py-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Settings</p>
        <a 
            href="#" 
            class="flex items-center px-3 py-2.5 text-sm text-gray-700 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition duration-200"
        >
            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Settings
        </a>

    </nav>

    {{-- Sidebar Footer --}}
    <div class="p-3 border-t border-gray-200 space-y-3">
        @if($activeCompany)
            <a href="{{ route('dashboard.company-infos.index') }}" class="block bg-indigo-50 rounded-md p-2.5 text-center hover:bg-indigo-100 transition">
                <p class="text-sm font-semibold text-indigo-800">{{ $activeCompany->name }}</p>
                <p class="text-xs text-indigo-600">Address: {{ $activeCompany->address ?? 'N/A' }}</p>
                <p class="text-xs text-indigo-600">Email: {{ $activeCompany->email ?? 'N/A' }}</p>
                <p class="text-xs text-indigo-600">Phone: {{ $activeCompany->phone ?? 'N/A' }}</p>
            </a>
        @else
            <p class="text-xs text-gray-400 text-center">No active company info set.</p>
        @endif

        {{-- Social Accounts --}}
        <div class="flex justify-center space-x-3 mt-2">
            <a href="#" class="text-indigo-600 hover:text-indigo-800" title="Social Accounts">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M22.46 6c-.77.35-1.5.59-2.32.69a4.08 4.08 0 001.8-2.27c-.79.46-1.66.8-2.59.98A4.12 4.12 0 0015.5 4c-2.27 0-4.11 1.84-4.11 4.11 0 .32.04.63.1.93-3.42-.17-6.45-1.81-8.47-4.31a4.08 4.08 0 00-.56 2.07c0 1.43.73 2.69 1.85 3.42a4.09 4.09 0 01-1.86-.51v.05c0 1.99 1.42 3.65 3.3 4.03a4.1 4.1 0 01-1.85.07c.52 1.63 2.04 2.82 3.83 2.85a8.23 8.23 0 01-5.1 1.76c-.33 0-.66-.02-.99-.06a11.63 11.63 0 006.29 1.84c7.55 0 11.68-6.26 11.68-11.68 0-.18-.01-.35-.02-.53A8.36 8.36 0 0024 4.56a8.19 8.19 0 01-2.36.65z"/>
                </svg>
            </a>
        </div>

    </div>


</aside>
