@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <article class="post-detail">
        <h1>{{ $post['title'] }}</h1>

        <p class="meta">
            Oleh {{ $post['author'] }} | {{ $post['created_at'] }}
        </p>

        <div class="content">
            {!! nl2br(e($post['content'])) !!}
        </div>

        <div class="post-actions">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
            <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-warning">Edit Post</a>
            <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" class="inline-form"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus post ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus Post</button>
            </form>
        </div>
    </article>
@endsection
