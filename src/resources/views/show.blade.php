@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="form">
    <div class="show-form__img">
        <img class="show-item__img" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
    </div>
    <div class="show-form">
        <div class="show-form__item">
            <p class="show-form__item-name">
                {{ $item->name }}
            </p>
            <p class="show-form__item-brandname">
                {{ $item->brandname }}
            </p>
            <p class="show-form__item-price">
                ¥{{ $item->price }}(税込)
            </p>
            <div>
                @if($item->like_users()->where('user_id', auth()->id())->exists())
                <form action="{{ route('unlike', ['item_id' => $item->id]) }}" method="POST" class="like-comment__btn">
                    @csrf
                    @method('DELETE')
                    <div class="like-btn">
                        <button type="submit" class="btn-success">
                            <img src="{{ asset('storage/星アイコン6.png') }}" alt="いいね解除" class="btn-success__img">
                        </button>
                        <div class="btn-success__count">{{ $item->like_users()->count() }}</div>
                    </div>
                    <div class="comment-btn">
                        <div type="submit" class="comment-btn">
                            <img src="{{ asset('storage/ふきだしのアイコン.png') }}" alt="いいね解除" class="comment-btn__img">
                        </div>
                        <div class="comment-btn__count">{{ $item->comment_users()->count() }}</div>
                    </div>
                </form>
                </a>
                @else
                <form action="{{ route('like', ['item_id' => $item->id]) }}" method="POST" class="like-comment__btn">
                    @csrf
                    <div class="like-btn">
                        <button type="submit" class="btn-secondary">
                            <img src="{{ asset('storage/星アイコン8.png') }}" alt="いいね" class="btn-secondary__img">
                        </button>
                        <div class="btn-success__count">{{ $item->like_users()->count() }}</div>
                    </div>
                    <div class="comment-btn">
                        <div class="comment-btn">
                            <img src="{{ asset('storage/ふきだしのアイコン.png') }}" alt="いいね解除" class="comment-btn__img">
                        </div>
                        <div class="comment-btn__count">{{ $item->comment_users()->count() }}</div>
                    </div>
                </form>
                @endif
            </div>
        </div>
        <div class="show-form__purchase">
            <form class="show-form" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="show-form__purchase-submit">
                    <a class="show-form__purchase-submit-a" href="{{ route('purchase', $item->id) }}">購入手続きへ</a>
                </div>
                <div class="show-form__content">
                    <label class="show-form__content-title">商品説明</label>
                    <p class="show-form__content-item">
                        {{ $item->description }}
                    </p>
                </div>
                <div class="show-form__info">
                    <label class="show-form__info-title">商品の情報</label>
                    <div class="show-form__info-content">
                        <div class="info-content__label">カテゴリー</div>
                        <div class="info-content__value">
                            @foreach($item->categories as $category)
                            <p class="category__item-label">{{ $category->category }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="show-form__info-category">
                        <div class="info-content__label">商品の状態</div>
                        <div class="info-content__condition">{{ $item['condition']['condition'] }}</div>
                    </div>
                </div>
                <div class="show-form__comment">
                    <label class="show-form__comment-title">コメント</label>
                    @foreach($item->comments as $comment)
                    <div class="show-form__comment-item">
                        <div class="comment-user">
                            <img class="user-img"
                                src="{{ asset('storage/' . $comment->user->image) }}" alt="{{ $comment->user->name }}">
                            <p class="user-name">{{ $comment->user->name }}
                            </p>
                        </div>
                        <p class="user-comment">{{ $comment->comment }}</p>
                    </div>
                    @endforeach
                </div>
            </form>
            <form action="{{ route('comment.store', ['item_id' => $item->id]) }}" method="POST" class="comment__btn">
                @csrf
                <div class="show-form__comment-input">
                    <label class="show-form__comment-input__title">商品へのコメント</label>
                    <textarea class="show-form__comment-input__textarea" name="comment" rows="8"></textarea>
                    <div class="form__error">
                        @error('comment')
                        {{ $message }}
                        @enderror
                    </div>
                    <button class="show-form__comment-input__button" type="submit">コメントを送信する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection