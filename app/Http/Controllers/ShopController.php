<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ShopController extends Controller
{
    public function list()//Todo：初回読み込み時にshop/list.blade.phpにアクセスした際に、favoritesテーブルにデータがある場合はボタンを登録済にするという挙動ができていない。
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $shops = Shop::all();
        $userFavorites = [];

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->favorites()->exists()) {
                $userFavorites = $user->favorites()->pluck('shop_id')->toArray();
            }
        }

        
        return view('shop.list', compact('shops', 'userFavorites'));
    }

    public function toggleFavorite(Request $request, $shopId) {
    
        // お気に入りの追加や削除後にリダイレクト
        return Redirect::route('shop.list');
    }


        
    public function create()
    {
        $categories = Category::all();
        return view('shops.create', compact('categories'));
    }


    public function search(Request $request)//Todo：検索結果が絞れてなさそう。
    {
        $shopName = $request->input('shop_name');
        $categoryId = $request->input('category_id');

        
        $query = Shop::query();

        if ($shopName) {
            $query->where('name', 'like', '%' . $shopName . '%');
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $shops = $query->get();

        // 検索結果がない場合はメッセージを表示
        $message = $shops->isEmpty() ? '条件に該当する店舗がありません。' : null;

        // 検索結果とメッセージをビューに渡す
        return view('shop.list', compact('shops', 'message'));
    }

    public function details(Request $request)
    {

        return view('favorite.list');

    }

   
}