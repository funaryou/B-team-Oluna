<?php

namespace App\Http\Controllers;

// use App\Models\Post;
use App\Models\Content;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 一覧表示
    public function index()
    {
        // １ページ10件まで表示（更新日時降順）
        $contents = Content::orderBy('created_at', 'desc')->paginate(10);

        return response()->json($contents);  // テスト：JSON形式で返す
        // return view('posts.index', compact('contents'));
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
        //
    }
}
