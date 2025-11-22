@extends('layouts.app')

@section('title', 'Tulis Post Baru')

@section('content')
    <h1>Tulis Post Baru</h1>

    <form action="{{ route('posts.store') }}" method="POST" class="form">
        @csrf

        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
            @error('title')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="author">Penulis</label>
            <input type="text" name="author" id="author" value="{{ old('author') }}" required>
            @error('author')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Konten</label>
            <textarea name="content" id="content" rows="10" required>{{ old('content') }}</textarea>
            @error('content')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn">Simpan Post</button>
    </form>
@endsection