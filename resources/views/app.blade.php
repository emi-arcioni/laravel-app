<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ url('/css/app.css') }}">

        <title>My Laravel App - @yield('title')</title>
    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ url('/') }}">My Laravel App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @auth
                    <li class="nav-item mr-3">
                        <a class="btn btn-primary" href="{{ url('/users/' . $user['id'] . '/entries/create') }}">New entry</a>
                    </li>
                    <li class="nav-item mr-3">
                        <span class="navbar-text text-light">
                            Welcome <a href="{{ url('/users/' . $user['id'] . '/entries') }}">{{ $user['name'] }}</a>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/users/' . $user['id'] . '/edit') }}">Edit user</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                    </li>
                    @endauth

                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Log in</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

        @section('content')
        @show

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="{{ url('/js/app.js') }}"></script>
    </body>
</html>