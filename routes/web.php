<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register']);



Route::middleware(['auth'])->group(function () {
    // Routes that require authentication
    Route::get('/dashboard', [UserController::class, 'showDashboard'])->name('dashboard');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // New route for displaying the create form
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // New route for handling form submission
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post}/comment', [PostController::class, 'addComment'])->name('posts.comment'); // New route for posting comments
    // Route for displaying the form to edit a post
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

    // Route for updating a post
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    // Route for deleting a post
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Route for user profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/posts/search', [PostController::class, 'searchPost'])->name('posts.search');
    Route::get('/posts/category/{category}', [PostController::class, 'postByCategory'])->name('posts.bycategory'); 
});
