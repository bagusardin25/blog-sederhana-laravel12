<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'author' => Auth::user()->name,
            'user_id' => Auth::id(), // Menyimpan ID user
        ]);

        return redirect()->route('posts.index')
                         ->with('success', 'Post berhasil dibuat!');
    }

    // Menampilkan detail post
    public function show(Post $post)
    {
        $post->load('comments.user');
        return view('posts.show', compact('post'));
    }

    // Menampilkan form edit
    public function edit(Post $post)
    {
        // Otorisasi: hanya pemilik yang boleh edit
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('posts.edit', compact('post'));
    }

    // Menyimpan perubahan post
    public function update(Request $request, Post $post)
    {
        // Otorisasi
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')
                         ->with('success', 'Post berhasil diperbarui!');
    }

    // Menghapus post
    public function destroy(Post $post)
    {
        // Otorisasi
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', 'Post berhasil dihapus!');
    }
}
