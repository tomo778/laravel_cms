@extends('layout.index')
@section('title', ' - ' . 'マイページ')
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
<h3>mypage</h3>
<p>お名前： {{ Auth::user()->name }}</p>
<p>メールアドレス： {{ Auth::user()->email }}</p>
@endsection