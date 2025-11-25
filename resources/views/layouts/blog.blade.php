<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Sederhana')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900 min-h-screen flex flex-col">
    <nav class="bg-white shadow mb-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('posts.index') }}" class="text-xl font-bold text-indigo-600">
                            Blog Sederhana
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-gray-500 text-sm">Halo, {{ Auth::user()->name }}</span>
                        <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Tulis Post
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">Log in</a>
                        <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 pb-12 flex-grow">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t mt-auto">
        <div class="container mx-auto px-4 py-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Blog Sederhana. All rights reserved.
        </div>
    </footer>
</body>
</html>
