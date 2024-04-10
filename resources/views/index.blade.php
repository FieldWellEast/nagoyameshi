<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>トップページ</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /* ナビゲーションメニューのスタイル */
        nav.navbar {
            background-color: #f8f9fa; /* ナビゲーションバーの背景色 */
            border-bottom: 1px solid #dee2e6; /* ナビゲーションバーの下部のボーダー */
            padding: 15px; /* ナビゲーションバーの上下の余白 */
        }

        /* ナビゲーションリンクのスタイル */
        .navbar-nav .nav-link {
            color: #007bff; /* リンクのテキスト色 */
            margin-left: 10px; /* 各リンクの左のマージン */
        }

        /* ナビゲーションリンクのホバースタイル */
        .navbar-nav .nav-link:hover {
            text-decoration: underline; /* ホバー時に下線を表示 */
        }

        /* フォームのスタイル */
        form {
            margin-top: 20px; /* フォームの上部のマージン */
        }

        /* フォーム内の要素のスタイル */
        .form-group {
            margin-bottom: 15px; /* 各フォームグループの下部のマージン */
        }

        /* 検索ボタンのスタイル */
        .btn-primary {
            background-color: #007bff; /* ボタンの背景色 */
            border-color: #007bff; /* ボタンのボーダー色 */
            color: #fff; /* ボタンのテキスト色 */
        }

        /* 検索ボタンのホバースタイル */
        .btn-primary:hover {
            background-color: #0056b3; /* ホバー時の背景色 */
            border-color: #0056b3; /* ホバー時のボーダー色 */
        }

        /* NAGOYAMESHIと会社情報・マイページの横並び */
        .navbar-brand,
        .navbar-nav {
            display: inline-block;
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('index') }}">NAGOYAMESHI</a>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('company') }}">会社情報</a></li>
                
                @guest <!-- ログインしていない場合のみ表示 -->
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">ログイン</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">新規登録</a></li>
                @else <!-- ログインしている場合 -->
                <li class="nav-item"><a class="nav-link" href="{{ route('mypage') }}">マイページ</a></li>
                @endguest
                
            </ul>
        </div>
    </nav>

    <div class="container">
    <!-- カテゴリーと店名検索フォーム -->
    <div>
        <form action="{{ route('shop.search') }}" method="GET">
            <div class="form-group">
                <label for="shop_name">店名:</label>
                <input type="text" class="form-control" id="shop_name" name="shop_name">
            </div>
            <div class="form-group">
                <label for="category_id">カテゴリー:</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="">カテゴリーを選択してください</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">検索</button>
        </form>
    </div>
</div>

</body>
</html>