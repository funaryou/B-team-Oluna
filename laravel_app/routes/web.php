<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, "index"])->name("web.top");

Route::get("/posts/{id}", [PostController::class, "show"])->name('web.posts.detail');

Route::get("/search", [PostController::class, "search"])->name('web.search');

Route::get('/admin/posts/create', [Admin\PostController::class, 'create'])->name('admin.posts.create');
Route::post('/admin/posts', [Admin\PostController::class, 'store'])->name('admin.posts.store');
