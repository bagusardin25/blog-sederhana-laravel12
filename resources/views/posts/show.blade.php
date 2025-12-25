@extends('layouts.blog')

@section('title', $post->title . ' - Blog Sederhana')

@section('content')
    <article class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-8">
            <div class="flex items-center justify-between mb-6 text-gray-500 text-sm border-b pb-4">
                <span>Ditulis oleh <strong class="text-gray-800">{{ $post->user->name }}</strong></span>
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

    <!-- Komentar Section -->
    <section class="max-w-3xl mx-auto mt-8 bg-white rounded-lg shadow-md overflow-hidden mb-12">
        <div class="p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Komentar ({{ $post->comments->count() }})</h2>

            <!-- Form Tambah Komentar -->
            @auth
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-8">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Tinggalkan Komentar</label>
                        <textarea name="content" id="content" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Tulis komentar Anda di sini..." required></textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Kirim Komentar
                    </button>
                </form>
            @else
                <p class="text-gray-600 mb-8 italic text-center py-4 bg-gray-50 rounded-lg">
                    Silakan <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-bold">login</a> untuk meninggalkan komentar.
                </p>
            @endauth

            <!-- Daftar Komentar -->
            <div class="space-y-6">
                @forelse ($post->comments as $comment)
                    <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-bold text-gray-900">{{ $comment->user->name }}</span>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700 whitespace-pre-line">{{ $comment->content }}</p>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Belum ada komentar.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
