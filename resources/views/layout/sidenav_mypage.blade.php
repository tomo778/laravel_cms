<h2>mypageメニュー</h2>
<ul class="nav flex-column">
    <li class="nav-item"><a class="nav-link" href="{{ route('mypage')}}">top</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('mypage_address')}}">住所情報</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('mypage_history')}}">購入履歴</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
            ログアウト
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>