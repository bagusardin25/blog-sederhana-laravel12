@extends('layouts.app')

@section('title', 'Semua Post')

@section('content')
    <h1>Semua Post</h1>

    @forelse($posts as $post)
        <article class="post-card">
            <h2>
                <a href="{{ route('posts.show', $post['id']) }}">
                    {{ $post['title'] }}
                </a>
            </h2>
            <p class="meta">
                Oleh {{ $post['author'] }} | {{ $post['created_at'] }}
            </p>
            <p>{{ Str::limit($post['content'], 150) }}</p>
        </article>
    @empty
        <p class="empty">Belum ada post. <a href="{{ route('posts.create') }}">Buat post pertama!</a></p>
    @endforelse
@endsection