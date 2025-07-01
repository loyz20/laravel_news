<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'News Portal')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow p-4 flex gap-6">
        <a href="{{ url('/') }}" class="font-bold">News Portal</a>
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ url('/search') }}">Cari</a>
        {{-- Kategori bisa di-loop --}}
        @foreach(\App\Models\Category::all() as $cat)
            <a href="{{ url('/category/'.$cat->slug) }}">{{ $cat->name }}</a>
        @endforeach
    </nav>
    <div class="container mx-auto py-8">
        @yield('content')
    </div>
    <footer class="text-center text-sm text-gray-500 py-8">
        &copy; {{ date('Y') }} News Portal
    </footer>
</body>
</html>
