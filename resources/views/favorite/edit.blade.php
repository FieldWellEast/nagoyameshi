<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>お気に入り編集</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->


    </head>
        <body>
        <div class="container">
        <form action="{{ route('favorite.update', $favorite->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="user_id">ユーザーID:</label>
        <input type="text" name="user_id" value="{{ $favorite->user_id }}"><br>
        
        <div>
        <label for="shop_name">店舗名:</label>
        <input type="text" id="shop_name" name="shop_name" value="{{ $shop->name }}" disabled style="width: 200px;">
        </div>

        <button type="submit">更新する</button>

         <button type="submit" onclick="return confirm('本当に削除しますか？')">削除する</button>
    </form>
        </div>
    </body>
</html>