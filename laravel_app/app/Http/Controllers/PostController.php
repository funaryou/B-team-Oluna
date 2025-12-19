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
        $contents = Content::orderBy('created_at', 'desc')->pagenate(10);

        return response()->json($contents);  // テスト：JSON形式で返す
        // return view('posts.index', compact('contents'));
    }

    // 詳細表示
    public function show($id)
    {
        //
    }

    // 検索
    public function search(Request $request)
    {
        //
    }
}
