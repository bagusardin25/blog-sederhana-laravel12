<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Menampilkan semua post
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    // Menampilkan form create
    public function create()
    {
        return view('posts.create');
    }

    // Menyimpan post baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => auth()->user()->name, // Mengambil nama user yang login
        ]);

        return redirect()->route('posts.index')
                         ->with('success', 'Post berhasil dibuat!');
    }

    // Menampilkan detail post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Menampilkan form edit
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Menyimpan perubahan post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            // Author tidak diupdate agar tetap sesuai pembuat aslinya
        ]);

        return redirect()->route('posts.index')
                         ->with('success', 'Post berhasil diperbarui!');
    }

    // Menghapus post
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', 'Post berhasil dihapus!');
    }
}
