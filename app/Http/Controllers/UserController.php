<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User; 
use App\Http\Controllers\Controller;
use Payjp\Payjp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // プロフィール画面を表示する   
    public function show($id)
    {
        // ユーザーがログインしているかどうかを確認
        if (Auth::check()) {
            // ログインしているユーザーのIDを取得
            $loggedInUserId = Auth::id();

            // ログインしているユーザーのIDとリクエストされたユーザーIDが一致するかを確認
            if ($loggedInUserId == $id) {
                // ユーザーがログインしているユーザー自身のページを表示
                $user = User::findOrFail($id);
                return view('user.show', ['user' => $user]);
            } else {
                // ログインしているユーザーとリクエストされたユーザーが異なる場合はエラーを返すか、リダイレクトするなど適切な処理を行う
                return redirect()->back()->with('error', 'You are not authorized to view this page.');
            }
        } else {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('login')->with('error', 'You need to login to view this page.');
        }
    }

    public function showPage()
    {
        $message = "Hello, this is a message.";
        return view('your.view', ['message' => $message]);
    }

    public function showUserProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
        
    }

    // プロフィールの更新を行う
    public function update(Request $request, $id)
    {
        // ユーザー情報のバリデーション
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8',
            'current_password' => 'nullable|string|min:8',
            'phone_number' => 'nullable|string|max:15', 
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
       
        // ユーザー情報の更新
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;


        // // パスワードが送信された場合のみ更新
        // if ($request->password) {
        //     if (!\Hash::check($request->current_password, $user->password)) {
        //         return redirect()->back()->with('error', '現在のパスワードが正しくありません。')->withInput();
        //     }
        //     $user->password = $request->password;
        // }
        
        // $user->phone_number = $request->phone_number;

        $user->save();
    
        // paid_membership_update_date を更新する
        if ($user->paid_membership) {
            $user->paid_membership_update_date = Carbon::now();
            $user->save();
        }
        
        return redirect()->route('user.show', ['id' => $user->id]);
        }
}