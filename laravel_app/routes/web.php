<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, "index"])->name("web.top");

Route::get("/posts/{id}", [PostController::class, "show"])->name('web.posts.detail');

Route::get("/search", [PostController::class, "search"])->name('web.search');

// Admin投稿用（CSRF無効）
Route::post('/admin/posts', [AdminPostController::class, 'store'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class])
    ->name('admin.posts.store');
