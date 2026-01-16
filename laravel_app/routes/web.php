<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render("index");
});

Route::get("/posts/{id}", function () {
    return Inertia::render("posts/detail");
})->name('web.posts.detail');
