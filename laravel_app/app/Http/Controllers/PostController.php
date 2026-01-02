<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 一覧表示
    public function index()
    {
        // １ページ10件まで表示（更新日時降順）
        $contents = Content::orderBy('created_at', 'desc')->paginate(10);

        return response()->json($contents);
    }

    // 詳細表示
    public function show($id)
    {
        $content = Content::find($id);

        if (!$content) {
            return response()->json(['error' => 'Content not found'], 404);
        }

        return response()->json($content);
    }

    // 検索
    public function search(Request $request)
    {
        // 検索キーワードを取得
        $query = $request->input('query');

        // タイトルまたはタグ名が一致する記事を取得
        $contents = Content::where('title', 'LIKE', "%$query%")
                            ->orWhereHas('tags', function($q) use ($query) {
                                $q->where('tags', 'LIKE', "%$query%");
                            })
                            ->get();

        // 該当記事がなかった場合
        if ($contents->isEmpty()) {
            return response()->json(['message' => '見つかりませんでした', 'data' => []], 200);
        }

        return response()->json($contents);
    }
}
