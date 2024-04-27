@extends('layout.index')
@section('title', ' - ' . 'お問い合わせ')
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
<h1>お問い合わせ</h1>
<form action="{{ route('contact_confirm') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group row">
        <label for="inputEmail" class="col-sm-2 col-form-label">名前</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="input_name" value="{{ old('name', @$request['name']) }}">
            <div class="err">
                {{@$errors->first('name')}}
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="validationTextarea" class="col-sm-2 col-form-label">ご感想</label>
        <div class="col-sm-10">
            <textarea type="text" name="kanso" rows="5" class="form-control" id="validationTextarea">{{ old('kanso', @$request['kanso']) }}</textarea>
            <div class="err">
                {{@$errors->first('kanso')}}
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">確認画面へ</button>
</form>
@endsection