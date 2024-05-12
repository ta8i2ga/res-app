<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <input type="checkbox" id="check">
        <label for="check" id="rese"><img width="20" height="25" src="https://img.icons8.com/color/48/000000/fries-menu.png" alt="fries-menu" />
            <label for="check" id="text">Rese</label>
        </label>
        <label for="check" id="batu">✖</label>
        <div class="sidebar">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                <li><a href="/mypage">Mypage</a></li>
            </ul>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>