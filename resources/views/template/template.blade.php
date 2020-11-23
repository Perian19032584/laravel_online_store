
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Интернет Магазин: @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/starter-template.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Интернет Магазин</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @routeactive('home2')><a href="/">Все товары</a></li>
                <li @routeactive('categor*')><a href="{{ route('categories') }}">Категории</a></li>

                <li @routeactive('basket*')><a href="{{ route('basket') }}">В корзину</a></li>
                <li><a href="http://internet-shop.tmweb.ru/locale/en">en</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">₽<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://internet-shop.tmweb.ru/currency/RUB">₽</a></li>
                        <li><a href="http://internet-shop.tmweb.rucategories/currency/USD">$</a></li>
                        <li><a href="http://internet-shop.tmweb.ru/currency/EUR">€</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @guest
                 <li><a href="{{ route('login') }}">Войти</a></li>
                @endguest

                @auth
                    @if(Auth::user()->isAdmin())
                        <li><a href="{{ route('home') }}">Панель администратора</a></li>
                    @else
                        <li><a href="{{ route('person.orders.home') }}">Мои заказы</a></li>
                    @endif
                        <li><a href="{{ route('get_logout') }}">Выйти</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@yield('content')

</body>
</html>
