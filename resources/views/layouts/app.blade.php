<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:700" rel="stylesheet">
    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <nav class="navbar{{--  navbar-fixed-top --}} bg-faded" role="navigation">
        <div class="container">
            <button class="pull-xs-right navbar-toggler hidden-md-up" type="button" data-toggle="collapse" data-target="#nav-collapse" aria-controls="nav-collapse" aria-expanded="false" aria-label="Toggle navigation">
                &#9776;
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('post.index') }}">
                Home
            </a>
            {{-- <a class="navbar-brand" href="{{ route('post.subscribes') }}">
                По подписке
            </a> --}}
            

            <div class="collapse navbar-toggleable-sm" id="nav-collapse">
                <ul class="nav navbar-nav pull-xs-right">
                    {{-- <form action="{{ route('post.index') }}" class="form-inline pull-xs-right">
                        <input type="search" name="search" placeholder="Search" value="{{ old('search') }}" class="form-control">
                        <button type="submit" class="btn btn-outline-success">Search</button>
                    </form> --}}
                    <li class="nav-item nav-category"><a href="#" class="nav-link">html & css</a></li>
                    <li class="nav-item nav-category"><a href="#" class="nav-link">javasript</a></li>
                    <li class="nav-item nav-category"><a href="#" class="nav-link">php</a></li>
                    <li class="nav-item nav-category"><a href="#" class="nav-link">database</a></li>
                    <li class="nav-item nav-category"><a href="#" class="nav-link">design & ux</a></li>
                    <li class="nav-item nav-category"><a href="#" class="nav-link">tools</a></li>
                    <li class="nav-item nav-category"><a href="#" class="nav-link">vcs</a></li>
                    <li class="nav-item nav-category"><a href="#" class="nav-link">others</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="toolbar">
        <div class="container">
            <ul class="toolbar-list">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="nav-item"><a href="{{ url('/login') }}" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="{{ url('/register') }}" class="nav-link">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            <li>
                                <a href="{{ route('cabinet.index') }}">Личный кабинет</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    @yield('content')

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>
