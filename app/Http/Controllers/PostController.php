<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Data dummy untuk contoh
    private function getPosts()
    {
        return [
            [
                'id' => 1,
                'title' => 'Belajar Laravel',
                'content' => 'Laravel adalah framework PHP yang populer.',
                'author' => 'Admin',
                'created_at' => '2024-01-15'
            ],
            [
                'id' => 2,
                'title' => 'Mengenal Blade Template',
                'content' => 'Blade adalah template engine bawaan Laravel.',
                'author' => 'Admin',
                'created_at' => '2024-01-16'
            ]
        ];
    }

    // Menampilkan semua post
    public function index()
    {
        $posts = $this->getPosts();
        return view('posts.index', compact('posts'));
    }

    // Menampilkan form create
    public function create()
    {
        return view('posts.create');
    }

    // Menyimpan post baru (contoh validasi)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required|max:100'
        ]);

        // Di sini nanti akan menyimpan ke database
        return redirect()->route('posts.index')
                         ->with('success', 'Post berhasil dibuat!');
    }

    // Menampilkan detail post
    public function show($id)
    {
        $posts = $this->getPosts();
        $post = collect($posts)->firstWhere('id', $id);
        return view('posts.show', compact('post'));
    }

    // [Opsional: Modul tidak menyertakan edit/update/destroy, tapi resource route ada]
    public function edit($id)
    {
        $posts = $this->getPosts();
        $post = collect($posts)->firstWhere('id', $id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required|max:100'
        ]);

        // Simulasi update
        return redirect()->route('posts.index')
                         ->with('success', 'Post berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Simulasi hapus
        return redirect()->route('posts.index')
                         ->with('success', 'Post berhasil dihapus!');
    }
}