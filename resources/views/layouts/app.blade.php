<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Sederhana')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('posts.index') }}" class="brand">Blog Sederhana</a>
            <a href="{{ route('posts.create') }}" class="btn">Tulis Post</a>
        </div>
    </nav>

    <main class="container">
        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Blog Sederhana. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>