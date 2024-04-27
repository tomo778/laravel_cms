@extends('layout.index')
@section('title', ' - ' . 'マイページ')
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
<h3>住所一覧</h3>
@if ($data->isEmpty())
<p><a href="{{ route('mypage_create')}}" class="btn btn-primary">住所登録</a></p>
<br>
@else
<p><a href="{{ route('mypage_create')}}" class="btn btn-primary">住所追加</a></p>
<br>
<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" width="100"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $k => $v)
            <tr>
                <th><a href="{{ route('mypage_update', ['id' => $v['id']]) }}">更新</a></th>
                <td>
                    〒{{$v['zip1']}}-{{$v['zip2']}}<br>
                    {{Config::get('const.pref.' . $v['pref'])}}
                    {{$v['address1']}} {{$v['address2']}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@if (!empty(session('cart.items')))
<p><a href="{{ route('purchase') }}" class="btn btn-primary">購入画面へ</a></p>
@endif
@endsection