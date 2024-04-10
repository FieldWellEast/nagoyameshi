<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopSearchController extends Controller
{
    public function search(Request $request)
    {
        // 入力された検索条件を取得
        $shopName = $request->input('shop_name');
        $categoryId = $request->input('category_id');

        // 検索クエリの組み立て
        $query = Shop::query();

        // 店名が入力されている場合は部分一致で検索条件に追加
        if (!empty($shopName)) {
            $query->where('name', 'like', '%' . $shopName . '%');
        }

        // カテゴリーが選択されている場合はカテゴリーで絞り込み
        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        // 検索結果を取得
        $shops = $query->get();

        // 検索結果をビューに渡して表示
        return view('shop.search', compact('shops'));
    }
}