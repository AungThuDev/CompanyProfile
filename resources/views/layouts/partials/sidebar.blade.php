<aside class="w-60 bg-white shadow-sm border-r border-gray-200 hidden md:flex flex-col">

    {{-- Flex wrapper to push footer down --}}
    <div class="flex flex-col flex-1 justify-between h-full overflow-hidden">

        {{-- Navigation (scrollable) --}}
        <nav class="flex-1 p-3 space-y-3 overflow-y-auto">

            {{-- Dashboard --}}
            <p class="px-3 pt-1 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Dashboard</p>
            <a href="{{ route('dashboard.index') }}" 
               class="flex items-center px-3 py-2.5 text-sm rounded-md transition duration-200
                   {{ request()->routeIs('dashboard.index') 
                       ? 'bg-indigo-50 text-indigo-700 font-medium' 
                       : 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>

            <div class="border-t border-gray-200"></div>

            {{-- User Management --}}
            <p class="px-3 pt-1 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">User Management</p>
            <a href="{{ route('dashboard.users.index') }}" 
               class="flex items-center px-3 py-2.5 text-sm rounded-md transition duration-200
                   {{ request()->routeIs('dashboard.users.*') 
                       ? 'bg-indigo-50 text-indigo-700 font-medium' 
                       : 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Users
            </a>

            <div class="border-t border-gray-200"></div>

            {{-- Projects --}}
            <p class="px-3 pt-1 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Projects</p>
            <a href="{{ route('dashboard.project-types.index') }}" 
               class="flex items-center px-3 py-2.5 text-sm rounded-md transition duration-200
                   {{ request()->routeIs('dashboard.project-types.*') 
                       ? 'bg-indigo-50 text-indigo-700 font-medium' 
                       : 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                Project Types
            </a>

            <a href="{{ route('dashboard.projects.index') }}" 
               class="flex items-center px-3 py-2.5 text-sm rounded-md transition duration-200
                   {{ request()->routeIs('dashboard.projects.*') 
                       ? 'bg-indigo-50 text-indigo-700 font-medium' 
                       : 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                Projects
            </a>

            <a href="{{ route('dashboard.services.index') }}" 
               class="flex items-center px-3 py-2.5 text-sm rounded-md transition duration-200
                   {{ request()->routeIs('dashboard.services.*') 
                       ? 'bg-indigo-50 text-indigo-700 font-medium' 
                       : 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Services
            </a>

            <div class="border-t border-gray-200"></div>

            {{-- Content Management --}}
            <p class="px-3 pt-1 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Content Management</p>
            <a href="{{ route('dashboard.categories.index') }}" 
               class="flex items-center px-3 py-2.5 text-sm rounded-md transition duration-200
                   {{ request()->routeIs('dashboard.categories.*') 
                       ? 'bg-indigo-50 text-indigo-700 font-medium' 
                       : 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                Categories
            </a>

            <a href="{{ route('dashboard.tags.index') }}" 
               class="flex items-center px-3 py-2.5 text-sm rounded-md transition duration-200
                   {{ request()->routeIs('dashboard.tags.*') 
                       ? 'bg-indigo-50 text-indigo-700 font-medium' 
                       : 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
                Tags
            </a>

            <a href="{{ route('dashboard.articles.index') }}" 
               class="flex items-center px-3 py-2.5 text-sm rounded-md transition duration-200
                   {{ request()->routeIs('dashboard.articles.*') 
                       ? 'bg-indigo-50 text-indigo-700 font-medium' 
                       : 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"></path>
                </svg>
                Articles
            </a>

        </nav>

        {{-- Footer --}}
        <div class="p-3 border-t border-gray-200">
            {{-- Active Company --}}
            @if($activeCompany)
                <a href="{{ route('dashboard.company-infos.index') }}"
                   class="block bg-indigo-50 rounded-md p-2.5 text-center hover:bg-indigo-100 transition">
                    <p class="text-sm font-semibold text-indigo-800">{{ $activeCompany->name }}</p>
                    <p class="text-xs text-indigo-600">Address: {{ $activeCompany->address ?? 'N/A' }}</p>
                    <p class="text-xs text-indigo-600">Email: {{ $activeCompany->email ?? 'N/A' }}</p>
                    <p class="text-xs text-indigo-600">Phone: {{ $activeCompany->phone ?? 'N/A' }}</p>
                </a>
            @else
                <a href="{{ route('dashboard.company-infos.index') }}">
                    <p class="text-xs text-gray-400 text-center">No active company info set.</p>
                </a>
            @endif

            {{-- Social Accounts --}}
            @if($activeCompany && $activeCompany->socialAccounts->isNotEmpty())
                <a href="{{ route('dashboard.social-accounts.index') }}"
                   class="block bg-indigo-50 rounded-lg p-3 hover:bg-indigo-100 transition group mt-2">

                    <div class="flex items-center justify-between">
                        <p class="text-xs font-semibold text-indigo-800">Social Accounts</p>
                        <span class="text-[10px] text-indigo-500 group-hover:text-indigo-700">Manage →</span>
                    </div>

                    <div class="flex justify-center space-x-3 mt-3">
                        @foreach($activeCompany->socialAccounts as $account)
                            <a href="{{ $account->account_link }}" target="_blank"
                               onclick="event.stopPropagation();"
                               class="p-1.5 bg-white border border-indigo-200 rounded-md shadow-sm
                                      hover:bg-indigo-50 hover:border-indigo-400 transition">
                                <img src="{{ asset('storage/' . $account->logo) }}" 
                                     alt="{{ $account->name }}" 
                                     class="w-5 h-5">
                            </a>
                        @endforeach
                    </div>

                    <p class="text-[11px] text-center text-indigo-600 mt-2 opacity-80 group-hover:opacity-100">
                        Click to manage all social accounts
                    </p>

                </a>
            @else
                <a href="{{ route('dashboard.social-accounts.index') }}" class="block mt-2">
                    <p class="text-xs text-gray-400 text-center">No active social accounts.</p>
                </a>
            @endif
        </div>

    </div>

</aside>
