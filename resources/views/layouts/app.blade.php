<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Frontend & Backend</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:500&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400i,400,700" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="/css/owl.theme.css">
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link href="/css/app.css" rel="stylesheet">
    
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <nav class="navbar {{-- navbar-fixed-top --}} bg-faded" role="navigation">
        <div class="container">
            <button class="pull-xs-right navbar-toggler hidden-md-up" type="button" data-toggle="collapse" data-target="#nav-collapse" aria-controls="nav-collapse" aria-expanded="false" aria-label="Toggle navigation">
                &#9776;
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('posts.index') }}">
                <img src="/img/logo.png" alt="Frontend & Backend" class="logo">
            </a>

            <div class="collapse navbar-toggleable-sm" id="nav-collapse">
                <ul class="nav navbar-nav pull-xs-right">
                    <li class="nav-item nav-category"><a href="{{ route('category.show', 'html-css') }}" class="nav-link html-css">html & css</a></li>
                    <li class="nav-item nav-category"><a href="{{ route('category.show', 'javascript') }}" class="nav-link js">javasript</a></li>
                    <li class="nav-item nav-category"><a href="{{ route('category.show', 'php') }}" class="nav-link php">php</a></li>
                    <li class="nav-item nav-category"><a href="{{ route('category.show', 'database') }}" class="nav-link db">database</a></li>
                    <li class="nav-item nav-category"><a href="{{ route('category.show', 'design-ux') }}" class="nav-link design">design & ux</a></li>
                    <li class="nav-item nav-category"><a href="{{ route('category.show', 'tools') }}" class="nav-link tools">tools</a></li>
                    <li class="nav-item nav-category"><a href="{{ route('category.show', 'vcs') }}" class="nav-link vcs">vcs</a></li>
                    <li class="nav-item nav-category"><a href="{{ route('category.show', 'others') }}" class="nav-link other">others</a></li>
                    <li class="nav-item nav-category dropdown">
                        <a href="#" class="nav-link dropdown-toggle additional" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                        @if (Auth::guest())
                               Sign in/up <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a href="{{ url('/login') }}" class="dropdown-item">Войти</a>
                                <a href="{{ url('/register') }}" class="dropdown-item">Регистрация</a>
                            </div>
                        @else
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a href="{{ route('cabinet.index') }}" class="dropdown-item">Личный кабинет</a>
                                <a href="{{ route('posts.subscribes') }}" class="dropdown-item">По подписке</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ url('/logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Выйти
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="toolbar">
        <div class="container">
            <ul class="toolbar-list">
            </ul>
        </div>
    </div>

    @yield('content')

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>
