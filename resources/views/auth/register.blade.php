@extends('layout.index')
@section('title', ' - ' . 'user登録')
@section('keywords', 'keywords')
@section('description', 'description')
@section('body')
<h1>user登録</h1>

<form class="form-horizontal" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

            @if ($errors->has('name'))
            <span class="err">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">メールアドレス</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

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

    <div class="form-group">
        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button disabled type="submit" class="btn btn-primary">
                登録
            </button>
        </div>
    </div>
</form>

@endsection