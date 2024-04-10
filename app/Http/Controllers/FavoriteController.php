<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;

class FavoriteController extends Controller
{
    public function toggle(Request $request, $shopId) 
    {
    if (!$shopId) {
        return response()->json(['error' => 'ショップIDが指定されていません'], 400);
    }

    if(auth()->check()) {
        $userId = auth()->user()->id;
        $favorite = Favorite::where('user_id', $userId)
                            ->where('shop_id', $shopId)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            $isFavorite = false;
        } else {
            $favorite = new Favorite();
            $favorite->user_id = $userId;
            $favorite->shop_id = $shopId;
            $favorite->save();
            $isFavorite = true;
        }

        return response()->json(['isFavorite' => $isFavorite]);
    } else {
        return response()->json(['error' => 'ログインが必要です'], 401);
    }
    }
    
    public function register()
    {
        return view('favorite.register');
    }

    public function list()
    {
        // ログインユーザーに紐づいたお気に入り添付一覧を取得
        $favorites = Favorite::where('user_id', auth()->id())->get();
        
        // 取得したお気に入り添付一覧をビューに渡す
        return view('favorite.list', ['favorites' => $favorites]);
    }

    // public function edit($id)
    // {
    //     return view('favorite.edit');
    // }

    public function showFavorites()
    {
        // お気に入りデータを取得
        $favorites = Favorite::all();

        // お気に入りに関連付けられた最初の店舗の ID を取得
        $firstFavorite = $favorites->first();
        $shopId = $firstFavorite->shop_id;

        // 店舗データを取得
        $shop = Shop::find($shopId);

        // ビューにデータを渡して表示
        return view('shop.details', compact('favorites', 'shop'));
    }
}