<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;

class SalesController extends Controller
{
    // Salesデータの一覧表示
    public function index()
    {
        $sales = Sales::all();
        return view('admin.sales.index', compact('sales'));
    }

    // Salesデータの詳細表示
    public function show($id)
    {
        $sale = Sales::findOrFail($id);
        return view('admin.sales.show', compact('sale'));
    }
    
    // 売り上げ登録処理
    public function registerSales()
    {
        // paid_membershipが1であるユーザーを取得
        $users = User::where('paid_membership', 1)->get();

        foreach ($users as $user) {
            // すでに当月の売り上げが登録されているかチェック
            $existingSale = Sales::where('user_id', $user->id)
                                ->whereYear('created_at', Carbon::now()->year)
                                ->whereMonth('created_at', Carbon::now()->month)
                                ->first();

            if (!$existingSale) {
                // 当月の売り上げがまだ登録されていない場合、300円を売り上げとして追加
                $sale = new Sales();
                $sale->user_id = $user->id;
                $sale->amount = 300;
                $sale->save();
            }
        }

        return redirect()->route('admin.sales.index')->with('success', '売り上げが正常に登録されました。');
    }
}