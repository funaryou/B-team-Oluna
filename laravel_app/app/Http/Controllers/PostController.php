<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * データ整形用共通メソッド
     */
    private function formatContent($content, $includeImages = false)
    {
        $formatted = [
            'id' => $content->id,
            'thumbnail' => '/storage/' . $content->thumbnail,
            'title' => $content->title,
            'text' => $content->text,
            'tags' => $content->tags->pluck('tags')->toArray(),
            'likes' => $content->likes,
        ];

        // 詳細表示の場合はimagesを追加
        if ($includeImages) {
            $formatted['images'] = $content->picture->map(function($item) {
                return "/storage/" . $item->picture;
            })->toArray();
        }

        return $formatted;
    }

    /**
     * 一覧表示
     */
    public function index()
    {
        // １ページ10件まで表示（更新日時降順）
        $contents = Content::with('tags')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        $formattedData = $contents->map(function($content) {
            return $this->formatContent($content, false);   // imagesは含めない
        });

        return Inertia::render("home", [
            'currentPage' => $contents->currentPage(),
            'perPage' => $contents->perPage(),
            'total' => $contents->total(),
            'lastPage' => $contents->lastPage(),
            'items' => $formattedData
        ]);
    }

    /**
     * 詳細表示
     */
    public function show($id)
    {
        $content = Content::with(['tags', 'picture'])->findOrFail($id);


        return Inertia::render("posts/detail", [
            'data' => $this->formatContent($content, true)  // imagesを含める
        ]);
    }

    /**
     * 検索
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // タイトルまたはタグ名が一致する記事を取得（１ページ10件まで）
        $contents = Content::where('title', 'LIKE', "%$keyword%")
                            ->orWhereHas('tags', function($q) use ($keyword) {
                                $q->where('tags', 'LIKE', "%$keyword%");
                            })
                            ->with('tags')
                            ->paginate(10);

        $formattedData = $contents->map(function($content) {
            return $this->formatContent($content, false);   // imagesは含めない
        });

        return Inertia::render("search", [
            'currentPage' => $contents->currentPage(),
            'perPage' => $contents->perPage(),
            'total' => $contents->total(),
            'lastPage' => $contents->lastPage(),
            'items' => $formattedData
        ]);
    }
}
