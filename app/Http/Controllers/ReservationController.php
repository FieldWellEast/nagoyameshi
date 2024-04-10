<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation; // Reservationモデルをインポート
use App\Models\Shop; // Shopモデルをインポート

class ReservationController extends Controller
{
    public function register()
    {
        // 予約フォームを表示するなどの処理

        // ビューを表示する
        return view('reservation.register');
    }

    public function index()
    {
        // ログインユーザーに紐づいた予約データを取得
        $user_id = auth()->id();
        $reservations = Reservation::where('user_id', $user_id)->get();
        
        // 取得した予約データをビューに渡す
        return view('reservation.list', ['reservations' => $reservations]);
    }

    public function list()
    {
         // ログインユーザーに紐づいた予約データを取得
        $user_id = auth()->id();
        $reservations = Reservation::where('user_id', $user_id)->get();
        
        // 取得した予約データをビューに渡す
        return view('reservation.list', ['reservations' => $reservations]);
    }

    public function edit($id)
    {
        // 予約情報を取得
        $reservation = Reservation::findOrFail($id);
        
        // 予約に関連付けられた店舗情報を取得
        $shop = Shop::findOrFail($reservation->shop_id);
        
        // 予約情報と店舗情報をビューに渡す
        return view('reservation.edit', compact('reservation', 'shop'));
    }

    public function update(Request $request, $id)
    {
        // 更新する予約データを取得
        $reservation = Reservation::findOrFail($id);

        // フォームから送信されたデータを更新
        $reservation->update([
            'user_id' => $request->input('user_id'),
            'shop_id' => $request->input('shop_id'),
            'reservation_date' => $request->input('reservation_date'),
            'people_count' => $request->input('people_count')
        ]);

        // 更新後にリダイレクトするなどの処理を行う
        return redirect()->route('reservation.index')->with('success', 'Reservation updated successfully');
    }

    public function store(Request $request)
    {
        // フォームのバリデーション
        $validatedData = $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'reservation_date' => 'required|date',
            'people_count' => 'required|integer|min:1', // 1以上の整数であることを確認する
        ]);

        // ログインしている場合は、ユーザーIDを取得し、ログインしていない場合は null を設定する
        $user_id = auth()->id();

        // 予約データの作成と保存
        $reservation = new Reservation();
        $reservation->user_id = $user_id; // ユーザーIDを設定
        $reservation->shop_id = $validatedData['shop_id'];
        $reservation->reservation_date = $validatedData['reservation_date'];
        $reservation->people_count = $validatedData['people_count'];
        $reservation->save();

        // リダイレクトと成功メッセージの返却
        return redirect()->route('reservation.list')->with('success', '予約が完了しました');
    }

    public function destroy($id)
    {
    // 指定されたIDの予約を取得
    $reservation = Reservation::findOrFail($id);

    // 予約を削除
    $reservation->delete();

    // 削除後に予約一覧ページにリダイレクト
    return redirect()->route('reservation.index')->with('success', '予約を削除しました');

    }


}