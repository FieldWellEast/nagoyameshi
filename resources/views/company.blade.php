<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>会社情報</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
</head>
<body>
<div class="container">
    <h1>会社情報</h1>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th>会社名</th>
            @foreach ($companies as $company)
                <td>{{ $company->company_name }}</td>
            @endforeach
        </tr>
        <tr>
            <th>代表</th>
            @foreach ($companies as $company)
                <td>{{ $company->ceo }}</td>
            @endforeach
        </tr>
        <tr>
            <th>設立</th>
            @foreach ($companies as $company)
                <td>{{ $company->establishment }}</td>
            @endforeach
        </tr>
        <tr>
            <th>郵便番号</th>
            @foreach ($companies as $company)
                <td>{{ $company->post_code }}</td>
            @endforeach
        </tr>
        <tr>
            <th>住所</th>
            @foreach ($companies as $company)
                <td>{{ $company->address }}</td>
            @endforeach
        </tr>
        <tr>
            <th>事業内容</th>
            @foreach ($companies as $company)
                <td>{{ $company->business }}</td>
            @endforeach
        </tr>
        </tbody>
    </table>
</div>
<div class="container">
    <h1>プライバシーポリシー</h1>
    <section>
        <h2>1. 収集する情報</h2>
        <p>当サイトでは、以下の方法で個人情報を収集する場合があります。</p>
        <ul>
            <li>お名前</li>
            <li>メールアドレス</li>
            <li>その他、お問い合わせフォームなどを通じて入力された情報</li>
        </ul>
    </section>
    <section>
        <h2>2. 収集した情報の利用</h2>
        <p>収集した個人情報は、以下の目的で利用される場合があります。</p>
        <ul>
            <li>お問い合わせに対する返信</li>
            <li>サービスの提供や運営のため</li>
            <li>新着情報やキャンペーンのご案内</li>
        </ul>
    </section>
    <section>
        <h2>3. 情報の共有と開示</h2>
        <p>収集した個人情報は、以下の場合を除いて第三者に提供されることはありません。</p>
        <ul>
            <li>法的要求に対応するため</li>
            <li>利用者の同意がある場合</li>
        </ul>
    </section>
    <section>
        <h2>4. Cookieの使用</h2>
        <p>当サイトでは、Cookieを使用して利用状況を分析し、サイトの改善に役立てる場合があります。</p>
    </section>
    <footer>
        <p>最終更新日: 2024年3月22日</p>
    </footer>
</div>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>