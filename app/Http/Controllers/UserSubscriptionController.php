<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Carbon\Carbon;
use Payjp\Payjp;
use Payjp\Plan;
use Payjp\Customer;
use Payjp\Subscription;
use Cart; 

class UserSubscriptionController extends Controller
{
    public function details()
    {
        // 有料会員情報の取得などの処理

        // ビューを表示する
        return view('user.subscription_details');
    }

    public function agreement() {
        // GETリクエストに対する処理を記述
        return view('user.subscription_agreement');
    }

    
    public function registerCard(Request $request)
    {
        $user = Auth::user();
    
        try {
            // Pay.jp APIキーの設定
            Payjp::setApiKey(config('services.payjp.secret'));
        
            // 顧客を作成または取得
            if (!$user->payjp_customer_id) {
                // 新しい顧客を作成
                \Illuminate\Support\Facades\Log::info('Creating new customer...');
                $customer = Customer::create([
                    'email' => $user->email, // ユーザーのメールアドレス
                    'card' => request('payjp-token'), // クレジットカードトークン
                ]);
                $user->payjp_customer_id = $customer->id;
                $user->save();
            } else {
                // 既存の顧客情報を使用
                \Illuminate\Support\Facades\Log::info('Retrieving existing customer...');
                $customer = Customer::retrieve($user->payjp_customer_id);
        
                // 既存の顧客に新しいクレジットカードを追加
                \Illuminate\Support\Facades\Log::info('Adding new card to existing customer...');
                $card = $customer->cards->create(['card' => request('payjp-token')]);
            }
    
            // 定期課金プランを取得
            $planId = 'monthly_subscription_300';
            $plan = Plan::retrieve($planId);

    
            // 顧客に定期課金を設定
            $subscription = Subscription::create([
                'customer' => $customer->id,
                'plan' => $plan->id, // プランIDを指定
                'prorate' => false, // プロレート計算を無効にする
            ]);
    
            // 定期課金の作成に成功した場合
            if ($subscription->id) {
                // 成功メッセージをリダイレクトして表示
                $user->paid_membership = 1; // paid_membershipフィールドを1に設定
                $user->save();
                return redirect()->route('user.edit', ['id' => $user->id])->with('success', 'クレジットカードが登録され、定期課金が適用されました。');
            } else {
                // エラーメッセージをリダイレクトして表示
                return redirect()->route('user.edit', ['id' => $user->id])->with('error', '定期課金の作成に失敗しました。');
            }
        } catch (\Exception $e) {//全てのエラー
            dd($e);

            \Illuminate\Support\Facades\Log::error($e->getMessage());
        } catch (\Payjp\Error\InvalidRequest $e) {
            // エラーが発生した場合の処理
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->route('user.edit', ['id' => $user->id])->with('error', 'クレジットカードの登録または定期課金の適用に失敗しました。');
        }

    }

    public function token(Request $request)
    {
        $user = Auth::user();
    
        try {
            $pay_jp_secret = config('services.payjp.secret');
            Payjp::setApiKey($pay_jp_secret);
    
            $customer = $user->payjp_customer_id;
    
            if ($customer != "") {
                $cu = Customer::retrieve($customer);
                $cardsData = $cu->cards->data;
                if (!empty($cardsData)) {
                    $delete_card = $cu->cards->retrieve($cardsData[0]["id"]);
                    $delete_card->delete();
                }
                $cu->cards->create([
                    "card" => request('payjp-token')
                ]);
            } else {
                $cu = Customer::create([
                    "card" => request('payjp-token')
                ]);
                $user->payjp_customer_id = $cu->id;
                $user->save();
            }
    
            return redirect()->route('register_card');
        } catch (\Payjp\Error\Base $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->route('register_card')->with('error', 'クレジットカードの登録に失敗しました。');
        }
    }
    
    public function cancelSubscription(Request $request)
    {
        // ユーザーを取得
        $user = Auth::user();
    
        // ユーザーが存在しない場合はエラーメッセージを表示
        if (!$user) {
            return redirect()->back()->with('error', 'ユーザーが見つかりませんでした');
        }
    
        try {
            // Pay.jp APIキーの設定
            Payjp::setApiKey(config('services.payjp.secret'));
    
            // 定期課金の解約
            if ($user->subscription_id) {
                Subscription::retrieve($user->subscription_id)->cancel();
                $user->subscription_id = null;
            }
    
            // 顧客のカード情報の削除
            if ($user->payjp_customer_id) {
                $customer = Customer::retrieve($user->payjp_customer_id);
                $customer->deleteCard();
            }
    
            // ユーザーの有料会員情報を更新
            $user->paid_membership = 0;
            $user->paid_membership_cancel_date = now();
            $user->save();
    
            // メッセージを表示
            return redirect()->route('user.edit', ['id' => $user->id])->with('success', '有料会員を解約しました');
        } catch (\Payjp\Error\Base $e) {
            // エラーハンドリング
            return redirect()->route('user.edit', ['id' => $user->id])->with('error', '有料会員の解約に失敗しました: ' . $e->getMessage());
        }
    }
    
    // public function apply(Request $request)
    // {
    //     // ユーザーのIDを取得する
    //     $userId = Auth::id();

    //     // 現在の日付を取得
    //     $currentDate = now();

    //     // usersテーブルの対象ユーザーのレコードを取得し、paid_membership_start_dateを更新
    //     $user = User::find($userId);
    //     $user->paid_membership_start_date = $currentDate;

    //     // 変更をデータベースに保存
    //     $user->save();

    //     // その他の処理（リダイレクトなど）を行う
    //     return redirect()->route('success_page');
    // }

    // public function destroy(Request $request)
    // {
    //     $user_shoppingcarts = DB::table('shoppingcart')->get();
    //     $number = DB::table('shoppingcart')->where('instance', Auth::user()->id)->count();

    //     $count = $user_shoppingcarts->count();

    //     $count += 1;
    //     $number += 1;

    //     // カート情報を保存
    //     Cart::instance(Auth::user()->id)->store($count);

    //     // 購入履歴を作成
    //     DB::table('shoppingcart')->where('instance', Auth::user()->id)
    //         ->where('number', null)
    //         ->update(
    //             [
    //                 'code' => substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10),
    //                 'number' => $number,
    //                 'price_total' => Cart::instance(Auth::user()->id)->total(),
    //                 'qty' => Cart::instance(Auth::user()->id)->count(),
    //                 'buy_flag' => true,
    //                 'updated_at' => date("Y/m/d H:i:s")
    //             ]
    //         );

    //     // 決済処理

    //     $pay_jp_secret = env('PAYJP_SECRET_KEY');
    //     \Payjp\Payjp::setApiKey($pay_jp_secret);

    //     $user = Auth::user();

    //     try {
    //         $res = \Payjp\Charge::create(
    //             [
    //                 "customer" => $user->token,
    //                 "amount" => Cart::instance(Auth::user()->id)->total(),
    //                 "currency" => 'jpy'
    //             ]
    //         );
    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         return redirect()->back()->with('error', '決済処理に失敗しました。');
    //     }

    //     // カートを空にする
    //     Cart::instance(Auth::user()->id)->destroy();

    //     return redirect()->route('carts.index');
    // }



    //     public function credit_edit()
    //     {
    //         // Pay.jpのAPIキーを設定
    //         Payjp::setApiKey(config('services.payjp.secret'));
        
    //         // ユーザーのPay.jp情報を取得
    //         $user = Auth::user();
    //         $customer = \Payjp\Customer::retrieve($user->token);
        
    //         // StripeのAPIキーを取得
    //         $stripeKey = env('STRIPE_KEY');
        
    //         // ビューにカード情報、ユーザー情報を渡す
    //         return view('card.edit', [
    //             'user' => $user,
    //             'customer' => $customer,
    //         ]);
    //     }
        
    //     public function showCard()
    //     {
    //         // ユーザーの認証
    //         $user = Auth::user();

    //         try {
    //             // Pay.jpのAPIキーを設定
    //             Payjp::setApiKey(config('services.payjp.secret'));

    //             // ユーザーのPay.jp顧客情報を取得
    //             $customer = \Payjp\Customer::retrieve($user->token);
                
    //             // ビューにカード情報とユーザー情報を渡して表示
    //             return view('card.show', ['user' => $user, 'customer' => $customer]);
    //         } catch (\Exception $e) {
                
    //             return redirect()->back()->with('error', 'カード情報の取得に失敗しました。');
    //         }
    //     }
   
    //     public function updateCard(Request $request)
    //     {
    //         // バリデーションルールの設定
    //         $rules = [
    //             'card_token' => 'required|string', // Pay.jpのカードトークン
    //         ];
            
    //         // バリデーションの実行
    //         $validatedData = $request->validate($rules);
            
    //         // ユーザーの認証
    //         $user = Auth::user();
            
    //         // Pay.jpのAPIキーを設定
    //         Payjp::setApiKey(config('services.payjp.secret'));
            
    //         try {
    //             // ユーザーのPay.jp顧客情報を取得
    //             $customer = \Payjp\Customer::retrieve($user->payjp_id); // payjp_idはPay.jpの顧客IDを保持するユーザーの属性です
                
    //             // 新しいカード情報を追加し、デフォルトカードとして設定
    //             $customer->cards->create(array(
    //                 "card" => $request->card_token
    //             ));
                
    //             // カスタマーオブジェクトを保存
    //             $customer->save();
                
                
    //             // 成功メッセージをセッションに格納してリダイレクト
    //             return redirect()->route('customer.edit')->with('success', 'カード情報が更新されました。');
    //         } catch (\Exception $e) {
    //             // エラーメッセージをセッションに格納してリダイレクト
    //             Log::error('Failed to update customer card: ' . $e->getMessage());
    //             return redirect()->back()->with('error', 'カード情報の更新に失敗しました。');
    //         }
    //     }
        
                 


}