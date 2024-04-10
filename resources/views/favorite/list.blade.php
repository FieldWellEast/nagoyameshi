<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>お気に入り添付一覧</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
</head>
<body>
<div class="container">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>店舗名</th>
            <th>登録日</th>
            <th>更新日</th>
        </tr>
        </theaSd>
        <tbody>
        @foreach ($favorites as $favorite)
        <tr>
            <td>{{ $favorite->id }}</td>
            <td><a href="{{ route('shop.details', ['id' => $favorite->shop_id]) }}">{{ $favorite->shop->name }}</a></td>
            <td>{{ $favorite->created_at }}</td>
            <td>{{ $favorite->updated_at }}</td>
            <td>  
        <form action="{{ route('favorite.destroy', $favorite->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
         </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>