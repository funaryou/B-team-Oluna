<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Picture;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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


        $content = DB::transaction(function () use ($validated, $request) {
            // サムネ画像を保存
            $thumbnailPath = $request->file('thumbnail')->store('thumbnailImage', 'public');

            // 記事を作成
            $content = Content::create([
                'title' => $validated['title'],
                'text' => $validated['text'],
                'thumbnail' => $thumbnailPath,
            ]);

            // タグを紐付け
            if (!empty($validated['tags'])) {
                $tagIds = [];
                foreach ($validated['tags'] as $tagName) {
                    $tag = Tag::firstOrCreate(['tags' => $tagName]);
                    $tagIds[] = $tag->id;
                }
                $content->tags()->attach($tagIds);
            }

            // 記事内画像を保存
            if (!empty($validated['images'])) {
                $pictureData = [];
                foreach ($validated['images'] as $image) {
                    $imagePath = $image->store('PostImage', 'public');
                    $pictureData[] = [
                        'content_id' => $content->id,
                        'picture'    => $imagePath,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                Picture::insert($pictureData);
            }

            // 作成したコンテンツを返す
            return $content;
        });


        // return redirect()->route('web.top')->with('success', '投稿が完了しました');

        // Postmanテスト用にJSON返却に変更
        return response()->json([
            'message' => '投稿が完了しました',
            'content' => $content->load(['tags', 'picture'])
        ], 201);
    }
}
