@extends('layout.index')
@section('title', ' - ' . '購入手続き')
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
<h1>購入手続き</h1>
<h4>送り先</h4>
<form action="{{ route('purchase_confirm') }}" method="post">
    {{ csrf_field() }}
    <p>※送り先住所の追加・変更は<a href="{{ route('mypage_address')}}">こちらから</a></p>
    <div class="mb-4">
        @if ($address_list->count() == 1)
        <div>
            〒{{$address_list[0]['zip1']}}-{{$address_list[0]['zip2']}}<br>
            {{$address_list[0]['PrefText']}}
            {{$address_list[0]['address1']}} {{$address_list[0]['address2']}}
        </div>
        <input type="hidden" name="address" value="{{$address_list[0]['id']}}">
        @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" width="50"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            @foreach (@$address_list as $k => $v)

            <tbody>
                <th>
                    <input type="radio" name="address" id="{{$v['id']}}" value="{{$v['id']}}" {{ old('address', session('purchase.address')) == $v['id'] ? 'checked' : '' }}>
                </th>
                <td>
                    <label for="{{$v['id']}}">
                        〒{{$v['zip1']}}-{{$v['zip2']}}<br>
                        {{Config::get('const.pref.' . $v['pref'])}}
                        {{$v['address1']}} {{$v['address2']}}
                    </label>
                </td>
            </tbody>
            @endforeach
        </table>
        @endif
        @if($errors->has('address'))<div class="err">{{ $errors->first('address') }}</div class="">@endif
    </div>
    <hr>
    <div class="mb-4">
        <h4>支払方法</h4>
        @foreach (Config::get('const.payway') as $k => $v)
        <div class="form-check">
            <input value="{{$k}}" id="{{$k}}" name="payway" type="radio" class="form-check-input" {{ old('payway', session('purchase.payway')) == $k ? 'checked' : '' }}>
            <label class="form-check-label" for="{{$k}}">{{$v}}</label>
        </div>
        @endforeach
    </div>
    <input type="submit" class="btn btn-primary" value="確認画面へ">
</form>
@endsection