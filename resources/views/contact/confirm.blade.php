@extends('layout.index')
@section('title', ' - ' . 'お問い合わせ')
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
<h1>お問い合わせ</h1>
<div class="mb-3 row">
    <label class="col-sm-2 col-form-label">名前：</label>
    <div class="col-sm-10">
        {{ session('contact.name') }}
    </div>
</div>
<hr>
<div class="mb-3 row">
    <label class="col-sm-2 col-form-label">ご感想：</label>
    <div class="col-sm-10">
        {!! nl2br(e(session('contact.kanso'))) !!}
    </div>
</div>
<hr>
<div class="mb-3">
    <form action="{{ route('contact') }}" method="post">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">戻る</button>
    </form>
</div>
<div class="mb-3">
    <form action="{{ route('contact_finish') }}" method="post">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">送信</button>
    </form>
</div>
@endsection