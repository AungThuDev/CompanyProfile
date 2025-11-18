<aside class="w-60 bg-white shadow-sm border-r border-gray-200 hidden md:flex flex-col">

    {{-- Navigation --}}
    <nav class="flex-1 p-3 space-y-2">

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

        {{-- Divider --}}
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
            href="#" 
            class="flex items-center px-3 py-2.5 text-sm text-gray-700 rounded-md hover:bg-indigo-50 hover:text-indigo-700 transition duration-200 {{ request()->routeIs('dashboard.tags.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : '' }}"
        >
            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
            Tags
        </a>
        <a 
            href="#" 
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

    {{-- Sidebar Footer / Support --}}
    <div class="p-3 border-t border-gray-200">
        <div class="bg-indigo-50 rounded-md p-2.5">
            <p class="text-xs text-indigo-800 font-medium">Need Help?</p>
            <p class="text-xs text-indigo-600 mt-1">Contact support</p>
        </div>
    </div>

</aside>
