@extends('layout.index')
@section('title', ' - ' . 'カート')
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
<h1>カート</h1>
@if (@$message == true)
<div class="alert alert-warning" role="alert">
    すでにカートに入っています。
</div>
@endif
@if (empty(session('cart.items')))
<div class="alert alert-secondary" role="alert">
    現在カートはからです。
</div>
@else
<table class="cart table">
    <thead>
        <tr>
            <th scope="col" width="100"></th>
            <th scope="col">商品名</th>
            <th scope="col" width="200">価格</th>
            <th scope="col" width="100">数量</th>
            <th scope="col" width="100"></th>
        </tr>
    </thead>
    <tbody>
        @foreach(session('cart.items') as $k => $v)
        <tr>
            @if (is_file(Config::get('const.thumbnail_path') . $v['file_name']))
            <td><img src="{{ asset(Config::get('const.thumbnail_path') . $v['file_name']) }}?{{@$v['updated_at']}}" alt="dummy" width="100"></td>
            @else
            <td><img src="{{Config::get('const.noimg_path')}}" alt="dummy" width="100"></td>
            @endif
            <td><a href="{{ route('product', ['id' => $v['id']]) }}">{{$v['title']}}</a></td>
            <td>{{number_format($v['price'])}}円</td>
            <td>
                <select name="quantity" class="quantity form-select" data-id="{{$v['id']}}">
                    @foreach (Config::get('const.quantity') as $k2 => $v2)
                    <option value="{{$k2}}" @if (@$v['quantity']==$k2) selected @endif>{{$v2}}</option>
                    @endforeach
                </select>
            </td>
            <td><a href="" class="del_btn" data-id="{{$v['id']}}">削除</a></td>
        </tr>
        @endforeach

    </tbody>
</table>
@endif
<div>
    @if (!empty(session('cart.items')))
    <p class="fs-4">合計{{number_format(session('cart.price'))}}円</p>
    @auth
    <a href="{{ route('purchase') }}" class="btn btn-primary purchase_btn">購入する</a>
    @endauth
    @guest
    <p>※購入するには、<a href="{{ route('login') }}">ログイン</a>が必要です。</p>
    <p>user登録がまだの方は<a href="{{ route('register') }}">こちら</a></p>
    @endguest
    @endif
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .fullOverlay {
        position: fixed;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 0.5;
        filter: alpha(opacity=50);
        -ms-filter: "alpha(opacity=50)";
        z-index: 9999;
    }
</style>
@endsection