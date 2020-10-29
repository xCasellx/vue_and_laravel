<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
    <div class="container">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExample09" style="">
            <ul class="navbar-nav mr-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/">Cabinet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Comments</a>
                    </li>
                @endauth
            </ul>
            <div class="my-2 my-md-0">
                @guest
                    <a class="btn btn-info text-white" href="{{route("login")}}"><strong>Login</strong></a>
                    <a class="btn btn-yellow" href="{{route("register")}}"><strong>Sign up</strong></a>
                @endguest
                @auth
                    <a class="btn btn-danger" href="{{route("logout")}}">Logout</a>
                @endauth
            </div>
        </div>
    </div>
</nav>


