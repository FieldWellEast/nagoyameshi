<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>店舗詳細</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <table border="1">
            <tbody>
                 <tr>
                    <th>写真</th>
                    <td><img src="{{ asset($shop->image) }}" alt="店舗画像" width="200px"></td>                    
                </tr>
                <tr>
                    <th>店名</th>
                    <td>{{ $shop->name }}</td>
                </tr>
                <tr>
                    <th>カテゴリー</th>
                    <td>{{ $shop->category->name }}</td> <!-- リレーションのプロパティを参照 -->
                </tr>
                <tr>
                    <th>価格帯（上限）</th>
                    <td>{{ number_format($shop->price_upper, 0) }}円</td> <!-- プロパティ名を小文字に修正 -->
                </tr>
                <tr>
                    <th>価格帯（下限）</th>
                    <td>{{ number_format($shop->price_lower, 0) }}円</td> <!-- プロパティ名を小文字に修正 -->
                </tr>
                <tr>
                    <th>営業時間(開店)</th>
                    <td>{{ \Carbon\Carbon::parse($shop->start_time)->format('H:i') }}</td>
                </tr>
                <tr>
                    <th>営業時間(閉店)</th>
                    <td>{{ \Carbon\Carbon::parse($shop->closings_time)->format('H:i') }}</td>
                </tr>
                <tr>
                    <th>郵便番号</th>
                    <td>{{ $shop->post_code }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $shop->address }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ $shop->phone_number }}</td>
                </tr>
                <tr>
                    <th>定休日</th>
                    <td>{{ $shop->regular_holiday }}</td>
                </tr>
            </tbody>
        </table>

        <!-- 予約フォームの追加 -->
        <form action="{{ route('reservation.store') }}" method="POST">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <label for="reservation_date">予約日時:</label>
            <input type="datetime-local" id="reservation_date" name="reservation_date" required><br>
            <label for="people_count">予約人数:</label>
            <input type="number" id="people_count" name="people_count" required min="1"><br>
            <button type="submit">予約する</button>
        </form>

        <table>
        <thead>
        <tr>
            <th>予約日時</th>
            <th>人数</th>
            <th>登録日</th>
            <th>更新日</th>
            <th></th> <!-- 編集ボタン用の列を追加 -->
        </tr>
        </thead>
        <tbody>
        @isset($reservations)
        @foreach ($reservations as $reservation)
        <tr>
            <td>{{ $reservation->reservation_date }}</td>
            <td>{{ $reservation->people_count }}</td>
            <td>{{ $reservation->created_at }}</td>
            <td>{{ $reservation->updated_at }}</td>
            <td>
                <form action="{{ route('reservation.edit', $reservation->id) }}" method="GET" style="display: inline-block;">
                    <button type="submit" class="btn btn-primary">編集</button>
                </form>
                <!-- 削除ボタンを追加 -->
                <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
            <tr>
                <td colspan="5">予約情報がありません。</td>
            </tr>
        @endisset
        </tbody>
    </table>


    <h2>レビュー一覧</h2>
    
    @if($noReviews)
        <p>レビューがありません。</p>
    @else
        <!-- レビューがある場合の表示 -->
        <h2>{{ $shop->name }}のレビュー一覧</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ユーザー名</th>
                    <th>評価</th>
                    <th>コメント</th>
                    <th>投稿日時</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->comment }}</td>
                        <td>{{ $review->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- レビュー登録ボタン -->
    <form action="/reviewpost" method="GET">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <button type="submit">レビューを登録する</button>
    </form>


</body>
</html>