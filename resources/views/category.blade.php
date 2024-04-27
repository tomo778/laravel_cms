@extends('layout.index')
@section('title', ' - ' . $category['title'])
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
<h1>{{$category['title']}}一覧</h1>
<div class="mb-4">
    {!! nl2br(e($category['text'])) !!}
</div>
@foreach (@$paginate as $k => $v)
@include('layout.part_item')
@endforeach
{{ $paginate->links('pagination::bootstrap-4') }}
@endsection