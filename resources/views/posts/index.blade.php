@extends('layouts.app')

@section('title', 'Semua Post')

@section('content')
    <div class="header-actions">
        <h1>Semua Post</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Tulis Post Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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

            <div class="post-actions">
                <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-sm btn-info">Lihat Detail</a>
                <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" class="inline-form" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus post ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </div>
        </article>
    @empty
        <p class="empty">
            Belum ada post.
            <a href="{{ route('posts.create') }}">Buat post pertama!</a>
        </p>
    @endforelse
@endsection
