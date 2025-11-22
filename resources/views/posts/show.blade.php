@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <article class="post-detail">
        <h1>{{ $post['title'] }}</h1>
        <p class="meta">
            Oleh {{ $post['author'] }} | {{ $post['created_at'] }}
        </p>
        <div class="content">
            {!! nl2br(e($post['content'])) !!}
        </div>
        <a href="{{ route('posts.index') }}" class="btn">Kembali</a>
    </article>
@endsection