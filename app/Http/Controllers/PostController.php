<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //Data dummy
    private function getPosts(){
        return [
            [
                'id' => 1,
                'title' => 'Belajar laravel12',
                'content' => 'Laravel adalah framework php yang popular.',
                'author' => 'Admin',
                'created_at' => '2025-20-11'
            ],
            [
                'id' => 2,
                'title' => 'Mengeal Blade Templaet',
                'content' => 'Blade adalah template engine bawaan laravel',
                'author' => 'Admin',
                'created_at' => '2025-20-11'
            ]
        ];
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

    //Menyimpan post baru (contoh validasi)
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:225',
            'content' => 'required',
            'author' => 'required|max:100'
        ]);

        //lalu code dibawah ini untuk menyimpan ke databasenya
        return redirect()->route('posts.index')
        ->with('success', 'Post berhasil dibuat!');
    }

    //Menampilkan detail post
    public function show($id){
        $posts = $this->getPosts();
        $post = collect($posts)->firstWhere('id', $id);
        return view('posts.show', compact('post'));
    }
}
