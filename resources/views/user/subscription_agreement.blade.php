<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サブスクリプション利用規約</title>
</head>
<body>
    <div>
        <h1>サブスクリプション利用規約</h1>
        <p>この利用規約（以下「本規約」といいます）は、サブスクリプションサービス（以下「本サービス」といいます）の利用に関する条件を定めるものです。本サービスを利用することで、利用者は本規約に同意したものとみなされますので、十分にお読みいただき、同意の上で本サービスをご利用ください。</p>

        <h2>1. サービス内容</h2>
        <ul>
            <li>本サービスは、B級グルメのレビュー情報を提供します。</li>
            <li>利用者は、本サービスの利用料金を支払うことにより、本サービスを利用できます。</li>
        </ul>

        <h2>2. 利用料金と支払い</h2>
        <ul>
            <li>利用料金は月額300円です。支払いは月額で行われ、自動継続課金となります。</li>
            <li>支払いはクレジットカードにより行われます。クレジットカード情報は安全に保管され、第三者に提供されることはありません。</li>
        </ul>

        <h2>3. 利用者の義務</h2>
        <ul>
            <li>利用者は、本サービスを利用する際に提供された情報が正確であることを保証します。</li>
            <li>利用者は、本サービスを不正な目的で利用しないことを約束します。</li>
        </ul>

        <h2>4. プライバシーポリシー</h2>
        <p>利用者の個人情報は、プライバシーポリシーに従って取り扱われます。プライバシーポリシーに関する詳細は<a href="{{ route('company') }}">こちら</a>をご確認ください。</p>

        <h2>5. 免責事項</h2>
        <ul>
            <li>本サービス提供者は、本サービスの利用により生じたいかなる損害に対しても責任を負いません。</li>
        </ul>

        <h2>6. 契約の終了</h2>
        <ul>
            <li>利用者は、いつでも本サービスの利用を解約することができます。解約手続きは<a href="{{ route('company') }}">こちら</a>までご連絡ください。</li>
        </ul>

        <h2>7. その他</h2>
        <ul>
            <li>本規約は、提供するサービスの性質に応じて変更されることがあります。変更後の規約は、本ウェブサイトに掲載された時点で効力を発生します。</li>
        </ul>

        <div class="d-flex justify-content-center">
        <div class="container w-50">
             @csrf
            @if (!empty($card))
            <h3>登録済みのクレジットカード</h3>
            <hr>
            <h4>{{ $card["brand"] }}</h4>
            <p>有効期限: {{ $card["exp_year"] }}/{{ $card["exp_month"] }}</p>
            <p>カード番号: ************{{ $card["last4"] }}</p>
            @endif

            <form action="{{ route('user.token') }}" method="post">
                @csrf
                @if (empty($card))
                <script type="text/javascript" src="https://checkout.pay.jp/" class="payjp-button" data-key="{{ env('PAYJP_PUBLIC_KEY') }}" data-on-created="onCreated" data-text="利用規約に同意してカードを登録する" data-submit-text="カードを登録する"></script>
                @else
                <script type="text/javascript" src="https://checkout.pay.jp/" class="payjp-button" data-key="{{ env('PAYJP_PUBLIC_KEY') }}" data-on-created="onCreated" data-text="カードを更新する" data-submit-text="カードを更新する"></script>
                @endif
            </form>
        </div>
    </div>


</form>
</body>
</html>