@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<form class="form" action="{{ route('soldout', $item->id) }}" method="POST">
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
                支払方法
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
                <p class="show-form__item-name">
                    〒 {{ $address->postcode ?? $profile->postcode}}
                </p>
                <p class="show-form__item-name">
                    {{ ($address->address ?? $profile->address) . ' ' . ($address->building ?? $profile->building) }}
                </p>
            </div>
        </div>
    </div>
    <div class="purchase-form__right">
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
                    支払方法
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
        <div class="purchase-form__submit">
            <button class="purchase-form__submit-a" type="submit">購入する</button>
        </div>
    </div>
</form>
@endsection