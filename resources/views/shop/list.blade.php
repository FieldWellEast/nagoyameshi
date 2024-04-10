<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>店舗一覧</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .favorite-btn {
            padding: 5px 10px;
            border: 1px solid #333;
            background-color: #f0f0f0;
            text-decoration: none;
            color: #333;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
        
<body>
    <div class="container">
        <h1>店舗一覧</h1>
        @if($shops->isEmpty())
            <p>店舗がありません。</p>
        @else
        @endisset
            <table border="1">
                <thead>
                    <tr>
                        <th>画像</th>
                        <th>店名</th>
                        <th>カテゴリー</th>
                        <th>価格帯（上限）</th>
                        <th>価格帯（下限）</th>
                        <th>営業時間(開店)</th>
                        <th>営業時間(閉店)</th>
                        <th>郵便番号</th>
                        <th>住所</th>
                        <th>電話番号</th>
                        <th>定休日</th>
                        <th>お気に入り登録</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shops as $shop)
                        <tr>
                            <td><a href="{{ route('shop.details', $shop->id) }}"><img src="{{ asset($shop->image) }}" alt="店舗画像" width="200px"></a></td>
                            <td><a href="{{ route('shop.details', $shop->id) }}">{{ $shop->name }}</a></td>
                            <td>{{ $shop->category->name }}</td>
                            <td>{{ number_format($shop->price_upper, 0) }}円</td>
                            <td>{{ number_format($shop->price_lower, 0) }}円</td>
                            <td>{{ \Carbon\Carbon::parse($shop->start_time)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($shop->closings_time)->format('H:i') }}</td>
                            <td>{{ $shop->post_code }}</td>
                            <td>{{ $shop->address }}</td>
                            <td>{{ $shop->phone_number }}</td>
                            <td>{{ $shop->regular_holiday }}</td>
                            <td>
                            <!-- お気に入りトグルボタン -->
                            <form id="favorite-form-{{ $shop->id }}" action="{{ route('favorite.toggle', $shop->id) }}" method="POST">
                            @csrf
                            <button class="favorite-btn" onclick="toggleFavorite(event, {{ $shop->id }})">
                            @if (!empty($userFavorites) && in_array($shop->id, $userFavorites))
                                    登録済
                            @else
                                    未登録
                            @endif
                                </button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

    </div>


    <script>
        function toggleFavorite(event, shopId) {
        event.preventDefault(); // デフォルトの動作をキャンセル

        var form = document.getElementById('favorite-form-' + shopId);
        var button = form.querySelector('.favorite-btn');

        // ボタンのテキストを変更し、無効化する
        button.innerText = '処理中...';
        button.disabled = true;

        // フォームデータを取得
        var formData = new FormData(form);

        // リクエストを作成
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('リクエストに失敗しました');
            }
        })
        .then(data => {
            if (data.isFavorite) {
                button.innerText = '登録済';
            } else {
                button.innerText = '未登録';
            }
        })
        .catch(error => {
            console.error(error);
        })
        .finally(() => {
            // ボタンを再び有効化する
            button.disabled = false;
        });
        }
    </script>

</body>
</html>