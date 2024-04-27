@extends('layout.index')
@section('title', ' - ' . 'user登録')
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">本登録</div>

            <div class="card-body">
                @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    メールが送信されました。
                </div>
                @endif

                メールを送信しました。メールからメールアドレスの認証をお願いします。<br>
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">確認メールを再送信する</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection