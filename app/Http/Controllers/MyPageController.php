<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MyPageController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        return view('user.mypage', compact('user'));
    }

    public function details()
    {
        // 会員情報の取得などの処理
        // ビューを表示する
        return view('user.details');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name') ?? $user->name;
        $user->email = $request->input('email') ?? $user->email;
        $user->save();
        return redirect()->route('mypage');
    }
}