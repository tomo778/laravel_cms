@extends('admin/_layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')
{{ Auth::user('admin')->name }}さん
@endsection