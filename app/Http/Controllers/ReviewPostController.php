<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Shop;

class ReviewPostController extends Controller
{
    // レビューを保存する
    public function store(Request $request)
    {
        // バリデーションルールの設定
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        // レビューを作成して保存
        $review = new Review();
        $review->shop_id = $request->shop_id;
        $review->user_id = auth()->user()->id; // ログインユーザーのIDを取得
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        // レビューが保存された後の処理（リダイレクトなど）
        return redirect()->back()->with('success', 'レビューが投稿されました！');
    }


    public function create($shopId) {
        $shop = Shop::findOrFail($shopId); // 店舗情報を取得
        return view('reviewpost', compact('shop'));
    }

    public function details($id)
    {
        $shop = Shop::findOrFail($id); // 店舗情報を取得
        $reviews = $shop->reviews; // 店舗に関連するレビューを取得
    
        // レビューが取得できなかった場合の処理
        if (!$reviews) {
            $noReviews = true;
        }
    
        return view('shop.details', compact('shop', 'reviews', 'noReviews')); // レビューデータをビューに渡す
    }
}