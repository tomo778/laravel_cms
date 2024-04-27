@extends('layout.index')
@section('title', ' - ' . 'ログイン')
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
<h1>ログイン</h1>
<p>user登録がまだの方は<a href="{{ route('register') }}">こちら</a></p>
<hr>
<form class="form-horizontal" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">メールアドレス</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>

            @if ($errors->has('email'))
            <span class="err">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label">Password</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password">

            @if ($errors->has('password'))
            <span class="err">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <!-- <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>
        </div>
    </div> -->

    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                ログイン
            </button>

            <a class="btn btn-link" href="{{ route('password.request') }}">
                Passwordをお忘れの方?
            </a>
        </div>
    </div>
</form>
@endsection