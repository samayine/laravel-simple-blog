<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// Home page route. If the user is authenticated, load only their posts 
// and pass them to the home view.
Route::get('/', function () {
    $posts = collect();
    if (Auth::check()) {
        $posts = Auth::user()
            ->posts()
            ->with('user')
            ->latest('id')
            ->get();
    }

    return view('home', ['posts' => $posts]);
})->name('home');

// Authentication endpoints: register, login, logout.
Route::post('/register', [UserController::class, 'register'])->name('auth.register');
Route::post('/logout', [UserController::class, 'logout'])->name('auth.logout');
Route::post('/login', [UserController::class, 'login'])->name('auth.login');

// Post CRUD routes protected by auth middleware.
// Only signed-in users may create, edit, update or delete posts.
Route::middleware('auth')->group(function () {
    Route::post('/create-post', [PostController::class, 'createPost'])->name('posts.create');
    Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen'])->name('posts.edit');
    Route::put('/edit-post/{post}', [PostController::class, 'updatePost'])->name('posts.update');
    Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'])->name('posts.delete');
});