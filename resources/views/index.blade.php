@extends('layout.index')
@section('title', '')
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
@foreach (@$pagination as $k => $v)
@include('layout.part_item')
@endforeach
{{ $pagination->links('pagination::bootstrap-4') }}
@endsection