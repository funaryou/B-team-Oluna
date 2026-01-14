<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * 一覧表示
     */
    public function index()
    {
        // １ページ10件まで表示（更新日時降順）
        $contents = Content::orderBy('created_at', 'desc')->paginate(10);

        return response()->json($contents);
    }

    /**
     * 詳細表示
     */
    public function show($id)
    {
        $content = Content::find($id);

        if (!$content) {
            return response()->json(['error' => 'Content not found'], 404);
        }

        return response()->json($content);
    }

    /**
     * 検索
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $page = $request->input('page');

        // タイトルまたはタグ名が一致する記事を取得（１ページ10件まで）
        $contents = Content::where('title', 'LIKE', "%$keyword%")
                            ->orWhereHas('tags', function($q) use ($keyword) {
                                $q->where('tags', 'LIKE', "%$keyword%");
                            })
                            ->with('tags')
                            ->paginate(10);

        // 該当記事がなかった場合
        if ($contents->isEmpty()) {
            return response()->json([
                'current_page' => 1,
                'per_page' => 10,
                'total' => 0,
                'data' => [],
                'message' => '見つかりませんでした',
            ], 200);
        }

        // 記事のデータ整形
        $formattedData = $contents->map(function($content) {
            return [
                'id' => $content->id,
                'thumbnail' => $content->thumbnail,
                'title' => $content->title,
                'text' => $content->text,
                'tag' => $content->tags->pluck('tags')->toArray(),  // 該当タグ名の配列
            ];
        });

        return response()->json([
            'current_page' => $contents->currentPage(),
            'per_page' => $contents->perPage(),
            'total' => $contents->total(),
            'last_page' => $contents->lastPage(),
            'data' => $formattedData
        ]);
    }
}
