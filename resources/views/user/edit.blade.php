<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>会員情報編集</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('会員情報編集') }}</div>

                <div class="card-body">
                    <!-- バリデーションエラーメッセージの表示 -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- 更新成功時のメッセージ -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('名前') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                        </div>
                    </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Eメールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('電話番号') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('パスワード確認') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>



                        <!-- 更新ボタン -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('会員情報を更新する') }}
                                </button>
                            </div>
                        </div>
                    </form>
                        
                    <div class="d-flex justify-content-between">
                    @if (!$user->paid_membership)
                        <!-- 有料会員に登録するボタン -->
                        <a href="{{ route('user.subscription_agreement') }}" class="btn btn-success btn-block">
                            有料会員に登録する
                        </a>
                    @else
                        <!-- クレジットカード情報を更新する -->
                        <!-- <a href="{{ route('card.show') }}" class="btn btn-primary btn-block">
                            {{ __('クレジットカード情報を更新する') }}
                        </a>-->
                        <!-- 有料会員を解約するボタン-->
                        <form action="{{ route('cancel_subscription') }}" method="POST">
                            @csrf
                            @method('PUT') <!-- HTTPメソッドをPUTに指定 -->
                            <button type="submit" class="btn btn-danger btn-block">有料会員を解約する</button>
                        </form>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</body>
</html>