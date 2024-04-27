@extends('layout.index')
@section('title', ' - ' . $result['title'])
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
<h1>{{$result['title']}}</h1>
<div class="mb-4">
    @foreach (@$result->add_category as $k2 => $v2)
    <a href="{{ route('category', ['id' => $v2['id']]) }}"><span class="badge text-bg-primary">{{$v2->title}}</span></a>
    @endforeach
</div>
<div class="mb-4">
    @if (is_file(Config::get('const.image_path') . $result['file_name']))
    <img src="{{ asset(Config::get('const.image_path') . $result['file_name']) }}?{{@$result['updated_at']}}">
    @else
    <img src="{{Config::get('const.noimg_path')}}">
    @endif
</div>
<p>{!! nl2br(e($result['text'])) !!}</p>
<p class="fs-4">{{number_format($result['price'])}}円</p>
<hr>
<form action="{{route('cart')}}" method="post">
    {{ csrf_field() }}
    <div class="col-md-3 mb-4">
        <label for="quantity" class="form-label">数量を選択</label>
        <select name="quantity" id="quantity" class="form-select">
            @foreach (Config::get('const.quantity') as $k => $v)
            <option value="{{$k}}" @if (@$Request['quantity']==$k) selected @endif>{{$v}}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="item_id" value="{{$result['id']}}">
    <input type="submit" class="btn btn-primary" value="カートに追加">
</form>
@endsection