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
    <p>{!! $subscriptionAgreement->content !!}</p>
</div>


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