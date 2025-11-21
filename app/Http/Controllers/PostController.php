<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //Mendapatkan data posts dari session (atau data dummy jika belum ada)
    private function getPosts(){
        $posts = session('posts', [
            [
                'id' => 1,
                'title' => 'Belajar laravel12',
                'content' => 'Laravel adalah framework php yang popular.',
                'author' => 'Admin',
                'created_at' => '2025-01-20'
            ],
            [
                'id' => 2,
                'title' => 'Mengeal Blade Templaet',
                'content' => 'Blade adalah template engine bawaan laravel',
                'author' => 'Admin',
                'created_at' => '2025-01-20'
            ]
        ]);

        // Simpan ke session jika belum ada
        if (!session()->has('posts')) {
            session(['posts' => $posts]);
        }

        return $posts;
    }

    //Menyimpan posts ke session
    private function savePosts($posts){
        session(['posts' => $posts]);
    }

    //Menampilkan semua post
    public function index(){
        $posts = $this->getPosts();
        return view('posts.index', compact('posts'));
    }

    //Menampilkan form create
    public function create(){
        return view('posts.create');
    }

    //Menyimpan post baru
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:225',
            'content' => 'required',
            'author' => 'required|max:100'
        ]);

        $posts = $this->getPosts();
        
        // Generate ID baru
        $maxId = collect($posts)->max('id') ?? 0;
        $newId = $maxId + 1;

        // Tambahkan post baru
        $newPost = [
            'id' => $newId,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author' => $request->input('author'),
            'created_at' => now()->format('Y-m-d')
        ];

        $posts[] = $newPost;
        $this->savePosts($posts);

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil dibuat!');
    }

    //Menampilkan detail post
    public function show($id){
        $posts = $this->getPosts();
        $post = collect($posts)->firstWhere('id', (int)$id);
        
        if (!$post) {
            abort(404, 'Post tidak ditemukan');
        }

        return view('posts.show', compact('post'));
    }

    //Menampilkan form edit
    public function edit($id){
        $posts = $this->getPosts();
        $post = collect($posts)->firstWhere('id', (int)$id);
        
        if (!$post) {
            abort(404, 'Post tidak ditemukan');
        }

        return view('posts.edit', compact('post'));
    }

    //Menyimpan perubahan post
    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|max:225',
            'content' => 'required',
            'author' => 'required|max:100'
        ]);

        $posts = $this->getPosts();
        $index = collect($posts)->search(function ($post) use ($id) {
            return $post['id'] == (int)$id;
        });

        if ($index === false) {
            abort(404, 'Post tidak ditemukan');
        }

        // Update post
        $posts[$index]['title'] = $request->input('title');
        $posts[$index]['content'] = $request->input('content');
        $posts[$index]['author'] = $request->input('author');

        $this->savePosts($posts);

        return redirect()->route('posts.show', $id)
            ->with('success', 'Post berhasil diupdate!');
    }

    //Menghapus post
    public function destroy($id){
        $posts = $this->getPosts();
        $posts = collect($posts)->reject(function ($post) use ($id) {
            return $post['id'] == (int)$id;
        })->values()->toArray();

        $this->savePosts($posts);

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil dihapus!');
    }
}
