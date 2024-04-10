<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>カード情報編集</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
        }
        #card-errors {
            color: #dc3545;
            margin-bottom: 10px;
        }
        .success-message {
            color: #28a745;
            margin-bottom: 10px;
            text-align: center;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* マイページに戻るボタンのスタイル */
        .back-to-mypage {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            border: 1px solid #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .back-to-mypage:hover {
            background-color: #0056b3;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>カード情報編集</h1>
        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('user.updateCard') }}">
            @csrf
            <label for="card_number">新しいカード番号</label>
            <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" value="{{ old('card_number') }}">
            <label for="exp_month">有効期限（月）</label>
            <input type="text" id="exp_month" name="exp_month" placeholder="MM" value="{{ old('exp_month') }}">
            <label for="exp_year">有効期限（年）</label>
            <input type="text" id="exp_year" name="exp_year" placeholder="YYYY" value="{{ old('exp_year') }}">
            <label for="cvc">CVC番号</label>
            <input type="text" id="cvc" name="cvc" placeholder="123" value="{{ old('cvc') }}">
            <!-- 名義人情報 -->
            <label for="name">名前</label>
            <input type="text" id="name" name="name" placeholder="TARO YAMADA" value="{{ old('name') }}">
            <!-- エラーメッセージを表示するための div -->
            <div id="card-errors" role="alert"></div>
            <button type="submit">カード情報を更新する</button>
        </form>
        <a href="{{ route('mypage') }}" class="back-to-mypage">マイページに戻る</a>
    </div>
</body>
</html>