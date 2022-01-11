<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">ReXsteam</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <a href="/" class="mr-auto nav-link text-white">Home</a>
            @auth
                @if (Auth::user()->role == 'Admin')
                    <a href="/admin/games" class="nav-link text-white">Manage Game</a>
                @endif
            @endauth
            <form class="form-inline" action="/search" method="GET">
                <input class="form-control mr-sm-2" type="text" name="name" placeholder="Search" aria-label="Search">
            </form>
            <ul class="navbar-nav">
                @auth
                    @if (Auth::user()->role == 'Member')
                        <li class="nav-item">
                            <a class="nav-link" href="/cart">CART</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <div class="dropdown btn-group">
                            <p id="dropdownMenuButton" class="nav-link" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                @<span>{{ Auth::user()->username }}</span>
                            </p>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/profile">Profile</a>
                                @if (Auth::user()->role == 'Member')
                                    <a class="dropdown-item" href="/friends">Friends</a>
                                    <a class="dropdown-item" href="/transactions">Transaction History</a>
                                @endif
                                <a class="dropdown-item" href="/logout">Sign out</a>
                            </div>
                        </div>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>


    <div class="mb-3">
        @yield('content')
    </div>

    <footer class="footer bg-dark text-light text-center sticky-bottom">
        <small>© ReXsteam - Vincent Low, Jiwa</small>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
