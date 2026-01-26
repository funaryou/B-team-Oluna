<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Picture;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * 投稿フォームを表示
     */
    public function create()
    {
        return Inertia::render('Admin/PostCreate');
    }

    /**
     * 新規投稿
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'tags'      => 'nullable|array',
            'tags.*'    => 'string|max:50',
            'text'      => 'required|string|min:10',
            'thumbnail' => 'required|image|max:2048',
            'images'    => 'nullable|array|max:5', // 最大５枚まで（仮）
            'images.*'  => 'image|max:2048',
        ]);

        // サムネ画像を保存
        $thumbnailPath = $request->file('thumbnail')->store('thumbnailImage', 'public');

        // 記事を作成
        $content = Content::create([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'thumbnail' => $thumbnailPath,
            'likes' => 0,
        ]);

        // タグを紐付け（自由入力対応）
        if (!empty($validated['tags'])) {
            $tagIds = [];

            foreach ($validated['tags'] as $tagName) {
                // タグが存在すれば取得、なければ新規作成
                $tag = Tag::firstOrCreate(['tags' => $tagName]);
                $tagIds[] = $tag->id;
            }

            // 中間テーブルに保存
            $content->tags()->attach($tagIds);
        }

        // 記事内画像を保存
        if (!empty($validated['images'])) {
            foreach ($validated['images'] as $image) {
                $imagePath = $image->store('PostImage', 'public');

                Picture::create([
                    'content_id' => $content->id,
                    'picture' => $imagePath,
                ]);
            }
        }

        // return redirect()->route('web.top')->with('success', '投稿が完了しました');


        // Postmanテスト用にJSON返却に変更
        return response()->json([
            'message' => '投稿が完了しました',
            'content' => $content->load(['tags', 'picture'])
        ], 201);
    }
}
