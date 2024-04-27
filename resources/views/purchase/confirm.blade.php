@extends('layout.index')
@section('title', ' - ' . '購入手続き')
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
{{ csrf_field() }}
<h1>確認画面</h1>
<div class="mb-4">
    <h4>お届け先</h4>
    〒{{session('purchase.address_detail.zip1')}}-{{session('purchase.address_detail.zip2')}}<br>
    {{session('purchase.address_detail.PrefText')}}
    {{session('purchase.address_detail.address1')}} {{session('purchase.address_detail.address2')}}
</div>
<hr>
<div class="mb-4">
    <h4>購入商品</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" width="100"></th>
                <th scope="col">商品名</th>
                <th scope="col" width="100">価格</th>
                <th scope="col" width="100">数量</th>
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
                <td>{{$v['title']}}</td>
                <td>{{number_format($v['price'])}}円</td>
                <td>{{$v['quantity']}}個</td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <p class="fs-4">合計{{number_format(session('cart.price'))}}円</p>
</div>
<hr>
<div class="mb-4">
    <h4>支払方法</h4>
    <p>{{Config::get('const.payway.' . session('purchase.payway'))}}</p>
</div>
<hr>
<form action="{{ route('purchase') }}" method="post" class="mb-4">
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="戻る">
</form>
<form action="{{ route('purchase_finish') }}" method="post">
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="購入する">
</form>
@endsection