@extends('layouts.app')
@section('content')
<div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
        <h1>マイページ</h1>

        <hr>

        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ms-2 mt-3">
                        <div class="d-flex flex-column">
                            <!-- 会員情報の編集へのリンク -->
                            <label for="user-name"><a href="{{ route('user.show', ['id' => $user->id]) }}">会員情報の編集</a></label>
                            <p>アカウント情報の編集ができます。</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('user.show', ['id' => $user->id]) }}">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr>

        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="fas fa-archive fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ms-2 mt-3">
                        <div class="d-flex flex-column">
                            <!-- 予約一覧へのリンク -->
                            <label for="user-name"><a href="{{ route('reservation.list') }}">予約一覧</a></label>
                            <p>予約済リストを確認できます。</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('reservation.list') }}">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr>

        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="fas fa-sign-out-alt fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ms-2 mt-3">
                        <div class="d-flex flex-column">
                            <!-- お気に入り店舗一覧へのリンク -->
                            <label for="user-name"><a href="{{ route('favorite.list') }}">お気に入り店舗一覧</a></label>
                            <p>お気に入り店舗リストを確認できます。</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('favorite.list') }}">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr>

    </div>
</div>
@endsection