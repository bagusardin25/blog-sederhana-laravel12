<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|min:3',
        ]);

        $post->comments()->create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}