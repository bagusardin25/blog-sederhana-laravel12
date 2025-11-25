@extends('layouts.blog')

@section('title', $post->title . ' - Blog Sederhana')

@section('content')
    <article class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-8">
            <div class="flex items-center justify-between mb-6 text-gray-500 text-sm border-b pb-4">
                <span>Ditulis oleh <strong class="text-gray-800">{{ $post->author }}</strong></span>
                <span>{{ $post->created_at->format('d F Y, H:i') }}</span>
            </div>

            <h1 class="text-4xl font-bold mb-6 text-gray-900">{{ $post->title }}</h1>

            <div class="prose max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($post->content)) !!}
            </div>

            <div class="mt-8 pt-8 border-t flex items-center justify-between">
                <a href="{{ route('posts.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                    &larr; Kembali ke Daftar Post
                </a>

                @auth
                    @if(auth()->id() === $post->user_id)
                        <div class="flex space-x-3">
                            <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Edit
                            </a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus post ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </article>
@endsection
