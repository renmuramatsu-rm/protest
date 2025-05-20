@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="mypage-profile__content">
        <div class="mypage-profile__content-item">
            <img class="mypage-profile__img" src="{{ asset('storage/' . ($profile->image ?? 'profiles/noimage.jpg')) }}">

        </div>
        <a href="{{ route('profile') }}" class="mypage-item__button-profile">プロフィールを編集</a>
        </form>
    </div>

    <ul class="mypage-list">
        <li class="mypage-list__item">
            <a href="/mypage?tab=sell" class="mypage-list__button-listing">出品した商品</a>
        </li>
        <li class="mypage-list__item">
            <a href="/mypage?tab=buy" class="mypage-list__button-buy">購入した商品</a>
        </li>
    </ul>
    <div class="mypage-item">
        @foreach ($items as $item)
        <div class="mypage-item_show">
            @if ($item->purchases)
            <p class='sold-out'>
                Sold Out
            </p>
            @endif
            <div class="mypage-item__content">
                <a href="{{ route('show', $item->id) }}">
                    <img class="mypage-item__img" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                </a>
                <p class="mypage-item__name">{{ $item->name }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="pagination">
        {{ $items->links() }}
    </div>
</div>
@endsection