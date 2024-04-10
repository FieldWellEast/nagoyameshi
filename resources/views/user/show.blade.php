<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>会員情報</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        /* ここに必要なCSSを追加します */
    </style>
</head>
<body>
<div class="container">
    <h1>会員情報</h1>

    <table class="table">
    <tr>
        <th>項目</th>
        <th>値</th>
    </tr>
    <tr>
        <td>お名前</td>
        <td>{{ $user->name }}</td>
    </tr>
    <tr>
        <td>メールアドレス</td>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <td>電話番号</td>
        <td>{{ $user->phone_number }}</td>
    </tr>
    <tr>
        <td>有料会員開始日</td>
        <td>{{ $user->paid_membership_start_date }}</td>
    </tr>
    <tr>
        <td>有料会員更新日</td>
        <td>{{ $user->paid_membership_update_date }}</td>
    </tr>
    <tr>
        <td>有料会員解約日</td>
        <td>{{ $user->paid_membership_cancel_date }}</td>
    </tr>
    </table>

    <!-- 更新ボタン -->
    <div class="form-group">
        <button id="updateButton" class="btn btn-primary">
            情報を更新する
        </button>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#updateButton').on('click', function(){
            let userId = '{{ $user->id }}';
            let editUrl = '{{ route("user.edit", ["id" => ":userId"]) }}';
            editUrl = editUrl.replace(':userId', userId);
            window.location.href = editUrl;
        });
    });
</script>
</body>
</html>