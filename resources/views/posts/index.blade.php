@extends('layouts.blog')

@section('title', 'Beranda - Blog Sederhana')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-4">Artikel Terbaru</h1>

        <div class="grid gap-8">
            @forelse($posts as $post)
                <x-post-card :post="$post" />
            @empty
                <div class="text-center py-12 bg-white rounded-lg shadow">
                    <p class="text-gray-500 text-lg">Belum ada postingan.</p>
                    @auth
                        <a href="{{ route('posts.create') }}" class="mt-4 inline-block text-indigo-600 hover:underline">
                            Mulai menulis sekarang
                        </a>
                    @endauth
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
