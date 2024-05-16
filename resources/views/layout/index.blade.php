<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="uft-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{Config::get('const.site_name')}}@yield('title')</title>
	@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/jquery.js'])
	<meta name="keywords" content="@yield('keywords')" />
	<meta name="description" content="@yield('description')" />
	<style>
		body {
			font-family: meiryo, "メイリオ", "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", sans-serif !important;
		}

		.h1,
		.h2,
		.h3,
		h1,
		h2,
		h3 {
			font-size: calc(1.3rem + .6vw);
			margin-bottom: 1.4rem;
		}

		hr {
			margin-top: 2rem;
			margin-bottom: 2rem;
		}

		img {
			-width: 100%;
			max-height: 500px;
			object-fit: cover;
		}

		.form-group {
			margin-bottom: 1.4rem;
		}

		.err {
			color: #ff00ff;
		}
	</style>
	</style>
</head>

<body>
	<div class="container mb-4">
		<header class="d-flex flex-wrap justify-content-center py-3 border-bottom ">
			<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
				<span class="fs-4">{{Config::get('const.site_name')}}</span>
			</a>
			<ul class="nav nav-pills">
				@if(Auth::check() && Auth::user()->hasVerifiedEmail())
				<li class="nav-item"><a href="{{ route('mypage') }}" class="nav-link">mypage</a></li>
				@else
				<li class="nav-item"><a href="{{ route('login') }}" class="nav-link">ログイン</a></li>
				<li class="nav-item"><a href="{{ route('register') }}" class="nav-link">user登録</a></li>
				@endif
				<li class="nav-item"><a href="{{ route('cart') }}" class="nav-link">カート</a></li>
				<li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">お問い合わせ</a></li>
			</ul>
		</header>
	</div>
	<div class="container mb-4">
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					@yield('body')
				</div>
			</div>
			<div class="col-md-4">
				<div class="row px-4">
					@if ( request()->is('mypage*') )
					@include('layout.sidenav_mypage')
					@else
					@include('layout.sidenav')
					@endif
				</div>
			</div>
		</div>
	</div> <!-- /container -->


	<footer class="footer mt-auto py-3 bg-light">
		<div class="container">
			<div id="pagetop"><a href="#">このページの先頭へ戻る</a></div>
			<small>Copyright &copy; 2020 {{Config::get('const.site_name')}} All Rights Reserved</small>
		</div>
	</footer>
	</div>
	@yield('script')
</body>

</html>