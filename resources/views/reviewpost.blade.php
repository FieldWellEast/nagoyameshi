<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>レビューを投稿する</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>{{ $shop->name }}へのレビューを投稿する</h2>
        <form action="{{ route('review.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> <!-- ログインユーザーのID -->
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            
            <label for="rating">評価:</label>
            <select name="rating" id="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select><br>
            
            <label for="comment">コメント:</label><br>
            <textarea name="comment" id="comment" rows="4" required></textarea><br>
            
            <button type="submit">投稿する</button>
        </form>
    </div>
</body>
</html>