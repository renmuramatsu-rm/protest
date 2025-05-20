@extends('layouts.authapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div>
    <p>
        登録していただいたメールアドレスに認証メールを送付しました。
        メール認証を完了してください
    </p>
    <a class="register__mail" href="/mypage/profile">認証はこちらから</a>
    <form method="post" action="{{ route('verification.send') }}">
        @csrf
        <button class="register__mail">
            認証メールを再送する</button>
    </form>
</div>


@endsection