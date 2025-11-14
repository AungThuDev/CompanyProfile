<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - TechWave</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    {{-- Navbar --}}
    @include('layouts.partials.nav')

    {{-- Main container --}}
    <div class="flex flex-1 overflow-hidden">

        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')

        {{-- Content --}}
        <main class="flex-1 overflow-auto p-5">
            @yield('content')
        </main>
    </div>


    {{-- JS --}}
    @vite('resources/js/app.js')
</body>
</html>
