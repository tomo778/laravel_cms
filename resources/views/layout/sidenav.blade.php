@if(Auth::check() && Auth::user()->hasVerifiedEmail())
<h2>ユーザー情報</h2>
<p>{{ Auth::user()->name }}さん</p>
<hr>
@endif
<h2>カテゴリ一覧</h2>
<ul class="nav flex-column">
    @foreach ($side_categorys as $k => $v)
    <li class="nav-item"><a class="nav-link" href="{{ route('category', ['id' => $v->id]) }}">{{$v->title}}</a></li>
    @endforeach
</ul>