@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<form class="form" action="{{ route('soldOut', $item->id) }}" method="POST">
    @csrf
    <div class="purchase-form">
        <div class="purchase-form__left">
            <div class="purchase-form__img">
                <img class="purchase-item__img" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
            </div>
            <div class="show-form__item">
                <p class="show-form__item-name">
                    {{ $item->name }}
                </p>
                <p class="show-form__item-price">
                    ¥{{ $item->price }}
                </p>
            </div>
        </div>
        <div class="purchase-form__method">
            <label class="show-form__method-title">
                支払い方法
            </label>
            <select name="purchase_method">
                <option hidden>選択してください</option>
                <option value="コンビニ支払い">コンビニ支払い</option>
                <option value="カード支払い">カード支払い</option>
            </select>
        </div>
        <div class="purchase-form__delivery">
            <div class="purchase-form__delivery-top">
                <label class="purchase-form__delivery-title">
                    配送先
                </label>
                <a class="purchase-form__delivery-change" href="{{ route('address', $item->id) }}">変更する</a>
            </div>
            <div>
                <input class="show-form__item-name" name="postcode" value="{{ $address->postcode ?? $profile->postcode}}" readonly>
                <input class="show-form__item-name" name="address" value="{{ ($address->address ?? $profile->address)}}" readonly>
                <input class="show-form__item-name" name="building" value=" {{ ($address->building ?? $profile->building) }}" readonly>
            </div>
        </div>
    </div>
    <div class=" purchase-form__right">
        <div class="purchase-form__item">
            <div class="purchase-form__item-box">
                <label class="purchase-form__label">
                    商品代金
                </label>
                <p class="show-form__item-price">
                    ¥{{ $item->price }}
                </p>
            </div>
            <div class="purchase-form__item-box">
                <label class="purchase-form__label">
                    支払い方法
                </label>
                <p class="show-form__item-price" id="box"> </p>
                <script>
                    let selector = document.querySelector('[name="purchase_method"]');

                    selector.addEventListener('change', (event) => {
                        let box = document.querySelector('#box');
                        box.textContent = event.target.value;
                    });
                </script>
            </div>
        </div>
        @if ($item->sold())
        <button class="btn disable" disabled>売り切れました</button>
        @elseif ($item->mine())
        <button class="btn disable" disabled>購入できません</button>
        @else
        <div class="purchase-form__submit">
            <button class="purchase-form__submit-a" type="submit">購入する</button>
        </div>
        @endif
    </div>
</form>
@endsection