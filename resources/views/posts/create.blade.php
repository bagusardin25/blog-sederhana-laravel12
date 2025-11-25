@extends('layouts.blog')

@section('title', 'Buat Post Baru - Blog Sederhana')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Buat Postingan Baru</h1>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <x-input-label for="title" :value="__('Judul Post')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="mb-6">
                <x-input-label for="content" :value="__('Konten')" />
                <textarea id="content" name="content" rows="10" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('content') }}</textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-900 underline">Batal</a>
                <x-primary-button>
                    {{ __('Simpan Post') }}
                </x-primary-button>
            </div>
        </form>
    </div>
@endsection
