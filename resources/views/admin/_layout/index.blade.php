<!doctype html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<title>管理画面</title>
	<link rel="stylesheet" href="{{ mix('/style/admin/app.css') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
	<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/" target="_blank">管理画面</a>
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="{{route('admin.logout')}}">ログアウト</a>
			</li>
		</ul>
	</nav>

	<div class="container-fluid mb-5">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<h6 class="d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
						管理画面
					</h6>
					<ul class="nav flex-column mb-2">
						<li class="nav-item">
							<a class="nav-link active" href="/admin/">
								トップ
							</a>
						</li>
					</ul>
					<hr>
					@if (Auth::user('admin')->id == 1)
					<h6 class="d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
						スタッフ管理
					</h6>
					<ul class="nav flex-column mb-2">
						<li class="nav-item">
							<a class="nav-link active" href="/admin/staff/">
								一覧
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="/admin/staff/edit/">
								新規登録
							</a>
						</li>
					</ul>
					<hr>
					@endif
					<h6 class="d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
						商品
					</h6>
					<ul class="nav flex-column mb-2">
						<li class="nav-item">
							<a class="nav-link active" href="/admin/product/">
								一覧
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="/admin/product/edit/">
								新規登録
							</a>
						</li>
					</ul>
					<hr>
					<h6 class="d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
						カテゴリ
					</h6>
					<ul class="nav flex-column mb-2">
						<li class="nav-item">
							<a class="nav-link active" href="/admin/category/">
								一覧
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="/admin/category/edit/">
								新規登録
							</a>
						</li>
					</ul>
					<hr>
				</div>
			</nav>
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h2 class="h2">
						{{ request()->path() }}
					</h2>
				</div>
				@yield('body')
			</main>
		</div>
	</div>
	<script src=" {{ mix('js/admin/app.js') }} "></script>
</body>

</html>