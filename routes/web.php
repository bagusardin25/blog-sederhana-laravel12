<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', [PostController::class, 'index'])->name('home');

// Protected routes for managing posts and profile
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        // Query Builder Example: Latest 5 posts
        $latestPosts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id') // Join example as per task
            ->select('posts.*', 'users.name as author_name')
            ->orderBy('posts.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', ['latestPosts' => $latestPosts]);
    })->name('dashboard');

    Route::resource('posts', PostController::class)->except(['index', 'show']);
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public routes for viewing posts
Route::resource('posts', PostController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';