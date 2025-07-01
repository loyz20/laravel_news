<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'BERITA')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#F7EBE1]">
    {{-- Include Navbar --}}
    @include('layouts.navigation')

    {{-- Main content area --}}
    
    <main>
        @yield('content')
    </main>
</body>
</html>
