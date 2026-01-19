<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    // サンプルデータ
    return Inertia::render("home", ["items" => [
        [
            "id" => 1,
            "title" => "Testtest",
            "text" => "Test Text",
            "likes" => 40,
            "thumbnail" => "",
            "tags" => [["tags" => "test"], ["tags" => "test2"]],
        ],
        [
            "id" => 2,
            "title" => "Testtest",
            "text" => "Test Text2",
            "likes" => 40,
            "thumbnail" => "",
            "tags" => [["tags" => "test"], ["tags" => "test2"]]
        ],
    ]]);
});

Route::get("/posts/{id}", function () {
    return Inertia::render("posts/detail");
})->name('web.posts.detail');
