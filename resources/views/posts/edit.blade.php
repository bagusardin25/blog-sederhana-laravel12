@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post['id']) }}" method="POST" class="form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title"
                   value="{{ old('title', $post['title']) }}" required>
            @error('title')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="author">Penulis</label>
            <input type="text" name="author" id="author"
                   value="{{ old('author', $post['author']) }}" required>
            @error('author')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Konten</label>
            <textarea name="content" id="content" rows="10" required>{{ old('content', $post['content']) }}</textarea>
            @error('content')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Post</button>
            <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection

