<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.top');               // 一覧
    Route::get('/search', [PostController::class, 'search'])->name('posts.search');     // 検索
    Route::get('/{id}', [PostController::class, 'show'])->name('posts.detail');         // 詳細
});
