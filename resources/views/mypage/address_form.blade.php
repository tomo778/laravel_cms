@extends('layout.index')
@section('title', ' - ' . 'マイページ')
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
@isset($data['id'])
<h1>住所情報-更新</h1>
<form action="{{ route('mypage_update_exe') }}" method="post">
    <input type="hidden" name="id" value="{{ old('id', @$data['id'])}}">
    @else
    <h1>住所情報-登録</h1>
    <form action="{{ route('mypage_create_exe') }}" method="post">
        @endif
        {{ csrf_field() }}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" width="200"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>郵便番号</th>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="zip1" value="{{ old('zip1', @$data['zip1'])}}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="zip2" value="{{ old('zip2', @$data['zip2'])}}" class="form-control">
                            </div>
                        </div>
                        @if($errors->has('zip1'))<div class="err">{{ $errors->first('zip1') }}</div class="">@endif
                        @if($errors->has('zip2'))<div class="err">{{ $errors->first('zip2') }}</div class="">@endif
                    </td>
                </tr>
                <tr>
                    <th>都道府県</th>
                    <td>
                        <select name="pref" class="form-control">
                            @foreach (Config::get('const.pref') as $k2 => $v2)
                            <option value="{{$k2}}" @if (old('pref', @$data['pref'])==$k2) selected @endif>{{$v2}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('pref'))<div class="err">{{ $errors->first('pref') }}</div class="">@endif
                    </td>
                </tr>
                <tr>
                    <th>住所1</th>
                    <td>
                        <input type="text" name="address1" value="{{ old('address1', @$data['address1'])}}" size="40" class="form-control">
                        @if($errors->has('address1'))<div class="err">{{ $errors->first('address1') }}</div class="">@endif
                    </td>
                </tr>
                <tr>
                    <th>住所2</th>
                    <td>
                        <input type="text" name="address2" value="{{ old('address2', @$data['address2'])}}" size="40" class="form-control">
                        @if($errors->has('address2'))<div class="err">{{ $errors->first('address2') }}</div class="">@endif
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-primary">送信</button>
    </form>
    @endsection