@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="toppage">
    <ul class="toppage-list">
        @if (Auth::check())
        <li class="toppage-list__item">
            <a href="{{ route('items.list', ['tab'=>'recommend', 'search'=>$search]) }}" class="toppage-list__button-recommend__login">おすすめ</a>
        </li>
        <li class="toppage-list__item">
            <a href="{{ route('items.list', ['tab'=>'mylist', 'search'=>$search]) }}" class="toppage-list__button-mylist__login">マイリスト</a>
        </li>
        @else
        <li class="toppage-list__item">
            <a href="{{ route('items.list', ['tab'=>'recommend', 'search'=>$search]) }}" class="toppage-list__button-recommend__logout">おすすめ</a>
        </li>
        <li class="toppage-list__item">
            <a href="{{ route('items.list', ['tab'=>'mylist', 'search'=>$search]) }}" class="toppage-list__button-mylist__logout">マイリスト</a>
        </li>
        @endif
    </ul>
    <div class="toppage-item">
        @foreach ($items as $item)
        @if (!Auth::check() || $item->user_id !== Auth::id())
        <div class="toppage-item_show">
            @if ($item->sold())
            <p class='sold-out'>
                Sold Out
            </p>
            @endif
            <div class="toppage-item__content">
                <a href="{{ route('show', $item->id) }}">
                    <img class="toppage-item__img" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                </a>
                <p class="toppage-item__name">{{ $item->name }}</p>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>

@endsection