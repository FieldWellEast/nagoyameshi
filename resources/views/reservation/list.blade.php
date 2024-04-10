<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>予約一覧</title>
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
            <th>会員ID</th>
            <th>店舗名</th>
            <th>予約日時</th>
            <th>人数</th>
            <th>登録日</th>
            <th>更新日</th>
            <th></th> <!-- 編集ボタン用の列を追加 -->
        </tr>
        </thead>
        <tbody>
        @foreach ($reservations as $reservation)
        <tr>
            <td>{{ $reservation->id }}</td>
            <td>{{ $reservation->user_id }}</td>
            <td>
                <a href="{{ route('shop.details', $reservation->shop()->first()->id) }}">
                    {{ $reservation->shop()->first() ? $reservation->shop()->first()->name : '該当する店舗が見つかりません' }}
                </a>
            </td>
            <td>{{ $reservation->reservation_date }}</td>
            <td>{{ $reservation->people_count }}</td>
            <td>{{ $reservation->created_at }}</td>
            <td>{{ $reservation->updated_at }}</td>
            <td>
                <!-- 編集ボタンをボタンに変更 -->
                <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-primary"><button>編集</button></a>
                <!-- 削除ボタンを追加 -->
                <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" style="display: inline-block;">
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